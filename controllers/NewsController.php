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
        require_once $_SERVER['DOCUMENT_ROOT'].'/views/index.php';
        return true;
    }

    public function show($id)
    {
        $itemNew = $this->newsModel->getNewById($id);
        require_once $_SERVER['DOCUMENT_ROOT'].'/views/itemNew.php';
        return true;
    }

    public function showCreateForm()
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/views/createForm.php';
        return true;
    }

    public function create()
    {
//        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/';
//        $uploadfile = $uploaddir . basename($_FILES['preview_image']['name']);
////        echo  $uploadfile;
////        die();
//        var_dump($uploadfile);
//        die();
//        if (copy($_FILES['preview_image']['tmp_name'], $uploadfile)) {
//            echo "Файл корректен и был успешно загружен.\n";
//            die();
//        } else {
//            echo "Возможная атака с помощью файловой загрузки!\n";
//        }
//
////        echo $_FILES['preview_image']['name'];
////        die();
        $itemNew = $this->newsModel->createNew($_POST['title'],$_POST['content'],$previewImage);
        return true;
    }
}