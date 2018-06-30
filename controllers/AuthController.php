<?php

namespace controllers;


class AuthController
{
    public function showLoginForm()
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/views/loginForm.php';
        return true;
    }

    public function authorize()
    {
        echo 'auth';
        return true;
    }


}