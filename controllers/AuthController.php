<?php

namespace controllers;


use models\User;

class AuthController
{
    private $userModel;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLoginForm()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
    }

    private function authenticate($login, $password)
    {
        $user = $this->userModel->getUserByLogin($login);
        $message = '';
        if (!$user) {
            $message = 'Неверный логин';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
        } elseif ($password != $user['password']) {
            $message = 'Неверный пароль';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
        }

        session_start();
        $_SESSION['logged_user'] = $user;
        return true;
    }

    public function authorize()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (empty($login) || empty($password)) {
            $message = 'Заполните обязательные поля';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
            return true;
        }
        $this->authenticate($login, $password);

        header('Location:/');
    }

    public function logout()
    {
        session_start();
        if(isset($_SESSION['logged_user'])){
        unset($_SESSION['logged_user']);
        session_destroy();
        header('Location:/');
        }
        return null;
    }


}