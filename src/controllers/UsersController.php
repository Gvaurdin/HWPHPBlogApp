<?php

namespace App\Blog\controllers;

use App\Blog\Helpers;
use App\Blog\model\User;
use App\Blog\views\Users;
class UsersController
{
    public function runAction($action)
    {
        $method = 'action' . ucfirst($action);
        if(method_exists($this, $method))
        {
            $this->$method();
        } else
        {
            Helpers::errorHandle("Action $action not found");
        }
    }
    public function actionIndex()
    {
        $users = new User();
        $view = new Users();
        $view->render($users->getAll());
    }

    public function actionUser()
    {
        echo "User";
    }
}