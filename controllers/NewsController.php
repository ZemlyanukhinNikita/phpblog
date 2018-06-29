<?php

namespace controllers;

class NewsController
{
    public function index()
    {
        echo 'index';
        return true;
    }

    public function show($id)
    {
        echo $id;
        echo 'show';
        return true;
    }
}