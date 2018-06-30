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

    public function index()
    {
        $newsList = $this->newsModel->getAllNews();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
    }

    public function show($id)
    {
        $itemNew = $this->newsModel->getNewById($id);
        $this->newsModel->updateViews($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/itemNew.php';
    }

    public function showCreateForm()
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
    }

    public function showEditForm($id)
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        $itemNew = $this->newsModel->getNewById($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/editForm.php';
    }

    private function imageUpload()
    {
        $imageName = $_FILES['preview_image']['name'];
        if ($imageName) {

            if ($_FILES['preview_image']['error'] == 0) {

                $tmpName = $_FILES['preview_image']['tmp_name'];
                $ext = pathinfo($imageName, PATHINFO_EXTENSION);
                $pathName = '/images/' . md5($imageName) . '.' . $ext;
                if (copy($tmpName, $_SERVER['DOCUMENT_ROOT'] . $pathName)) {
                    return $pathName;
                } else {
                    return null;
                }
            }
        }
    }

    public function create()
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        //todo check form fields, and validate image
        $previewImage = null;
        if ($_FILES['preview_image']['name']) {
            $previewImage = $this->imageUpload();
        }
        $message = [];
        if (empty($_POST['title'])) {
            $message[] = 'Пустая строка';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
        }

        $itemNewId = $this->newsModel->createNew($_POST['title'], $_POST['content'], $previewImage);
        header('Location:/news/' . $itemNewId);
    }

    public function edit($id)
    {
        if (!$this->userModel->isAdmin()) {
            header('Location:/');
        }
        $previewImage = null;
        if ($_FILES['preview_image']['name']) {
            $previewImage = $this->imageUpload();
        }

        $this->newsModel->editNew($id, $_POST['title'], $_POST['content'], $previewImage);
        header('Location:/news/' . $id);
    }
}