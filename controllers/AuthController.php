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

    /**
     * Метод который возвращает форму для авторизации пользователя
     */
    public function showLoginForm()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
    }

    /**
     * Метод аутентифицирует пользователя и записывает его в сессиию,
     * если логин и пароль совпадают с логином и паролем этого пользователя в базе данных
     * @param $login
     * @param $password
     * @return bool
     */
    private function authenticate($login, $password)
    {
        $user = $this->userModel->getUserByLogin($login);

        $errorMessage = '';
        if (($user['login'] == $login) && password_verify($password, $user['password'])) {
            $_SESSION['logged_user'] = $user;
            return true;
        }

        if ($login != $user['login']) {
            $errorMessage = 'Неверный логин';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
        } else {
            $errorMessage = 'Неверный пароль';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
        }
    }

    /**
     * Метод редиректит пользовтеля на главную, если он ввел правильные логин и пароль
     * если что либо не ввел, возвращается форма авторизации
     */
    public function authorize()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (empty($login) || empty($password)) {
            $message = 'Заполните обязательные поля';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/loginForm.php';
        } elseif ($this->authenticate($login, $password)) {
            header('Location:/');
        }
    }

    /**
     * Метод разлогирования пользователя
     * @return null
     */
    public function logout()
    {
        if (isset($_SESSION['logged_user'])) {
            unset($_SESSION['logged_user']);
            session_destroy();
            header('Location:/');
        }
        return null;
    }


}