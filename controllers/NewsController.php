<?php

namespace controllers;

use models\News;

class NewsController
{
    private $newsModel;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsModel = new News();
    }

    public function index()
    {
        $newsList = $this->newsModel->getAllNews();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
        return true;
    }

    public function show($id)
    {
        $itemNew = $this->newsModel->getNewById($id);
        $this->newsModel->updateViews($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/itemNew.php';
        return true;
    }

    public function showCreateForm()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/createForm.php';
        return true;
    }

    public function showEditForm($id)
    {
        $itemNew = $this->newsModel->getNewById($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/editForm.php';
        return true;
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
        //todo check form fields, and validate image
        $previewImage = null;
        if ($_FILES['preview_image']['name']) {
            $previewImage = $this->imageUpload();
        }

        $itemNewId = $this->newsModel->createNew($_POST['title'], $_POST['content'], $previewImage);

        header('Location:/news/' . $itemNewId);
        return true;
    }

    public function edit($id)
    {
        $previewImage = null;
        if ($_FILES['preview_image']['name']) {
            $previewImage = $this->imageUpload();
        }

        $itemNew = $this->newsModel->editNew($id, $_POST['title'], $_POST['content'], $previewImage);

        header('Location:/news/' . $id);
        return true;
    }
}