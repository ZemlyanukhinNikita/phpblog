<?php

namespace controllers;

use models\News;
use models\User;

class NewsController
{
    private $newsModel;
    private $userModel;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsModel = new News();
        $this->userModel = new User();
    }

    /**
     * Метод, который передает в вид 'index.php' все новости
     */
    public function index()
    {
        $newsList = $this->newsModel->getAllNews();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
    }

    /**
     * Метод, который передает в вид 'itemNew.php' новость
     * с идентификатором $id
     * @param $id
     */
    public function show($id)
    {
        $itemNew = $this->newsModel->getNewById($id);
        $this->newsModel->updateViews($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/itemNew.php';
    }

    /**
     * Метод возвращает форму создания статьи,
     * если пользователь является администратором
     */
    public function showCreateForm()
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
    }

    /**
     * Метод возвращает форму редактирования статьи с идентификатором $id,
     * если пользователь является администратором
     * @param $id
     */
    public function showEditForm($id)
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        $itemNew = $this->newsModel->getNewById($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/editForm.php';
    }

    /**
     * Метод загрузки картинки
     * возвращает путь до картинки, если успешно загружена
     * возврашает null если не удалось загрузить
     * @return null|string
     */
    private function imageUpload()
    {
        //todo render the method of loading the image into a separate ImageService
        //todo add the removal of the picture from the server, do the validation
        $imageName = $_FILES['preview_image']['name'];

        if (!$imageName) {
            return null;
        }

        if ($_FILES['preview_image']['error'] != 0) {
            return null;
        }

        $tmpName = $_FILES['preview_image']['tmp_name'];
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $pathName = '/images/' . time() . md5($imageName) . '.' . $ext;

        if (copy($tmpName, $_SERVER['DOCUMENT_ROOT'] . $pathName)) {
            return $pathName;
        }
        return null;
    }

    /**
     * Метод создания новости
     */
    public function create()
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }

        if (!$this->isValidateFields()) {
            $errorMessage = 'Заполните обязательные поля';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
        } else {
            $postData = $this->filteringData();

            $previewImage = null;
            if ($_FILES['preview_image']['name']) {
                $previewImage = $this->imageUpload();
            }
            $itemNewId = $this->newsModel->createNew($postData['title'], $postData['content'], $previewImage);
            header('Location:/news/' . $itemNewId);
        }
    }

    /**
     * Метод редактирования новости с идентификатором $id
     * @param $id
     */
    public function edit($id)
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }

        if (!$this->isValidateFields()) {
            $errorMessage = 'Заполните обязательные поля';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
        } else {
            $postData = $this->filteringData();

            $previewImage = null;

            if ($_FILES['preview_image']['name']) {
                $previewImage = $this->imageUpload();
            }
            $this->newsModel->updateNew($id, $postData['title'], $postData['content'], $previewImage);
            header('Location:/news/' . $id);
        }
    }

    /**
     * Метод валидации полей title и content
     * убирает html теги
     * возвращает false если хотя бы одно поле не заполнено
     * возвращает массив с элементами title и content, если оба поля заполнены
     * @return array|bool
     */
    private function isValidateFields()
    {
        if (empty($_POST['title']) || empty($_POST['content'])) {
            return false;
        }
        return true;
    }

    private function filteringData()
    {
        $title = strip_tags($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        return ['title' => $title, 'content' => $content];
    }
}