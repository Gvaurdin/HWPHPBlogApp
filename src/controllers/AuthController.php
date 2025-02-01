<?php

namespace App\Blog\controllers;

use App\Blog\cookies\VisitCounter;
use App\Blog\model\Account;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        //ищем акк по логину
        $account = Account::getOneByLogin($login);

        if($account && $account->verifyPassword($pass)){
            session_start();
            //счетчик посещений срабатывает при каждом входе пользователя в аккаунт
            VisitCounter::updateVisitCount($account->login);
            $_SESSION['login'] = $account->login;
            $_SESSION['userType'] = $account->getUserType();
            header('Location: /');
            exit();
        } else
        {
            // если ошибка, направляем назад на сраницу авторизации с ошибкой
            $_SESSION['error'] = "Неверный логин или пароль";
            header('Location: /?c=home&a=index');
            exit();
        }

    }

    public function actionLogout()
    {

        session_destroy();

        // удаляем куки сессии на клиенте
        setcookie(session_name(), '', time() - 3600, '/');
        header('Location: /');
        exit();

    }

}