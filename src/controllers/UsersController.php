<?php

namespace App\Blog\controllers;

use App\Blog\Helpers;
use App\Blog\model\Post as Post;
use App\Blog\model\User;
use App\Blog\views\users\Users;

class UsersController extends Controller
{

    public function actionIndex()
    {
        $users = User::getAll();

        $message = $_SESSION['message'] ?? null;
        $_SESSION['message'] = null;

        echo $this->render('users/index', [
            'users' => $users,
            'message' => $message
        ]);
    }

    public function actionSave()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];


        $_SESSION['message'] = null;


        if (empty($title)) {
            $_SESSION['message'] = "Title is required";
            header('Location: /posts');
            exit;
        }


        $post = new Post($title, $text);
        $post->save();


        $_SESSION['message'] = "Post saved";
        header('Location: /posts');

    }

    public function actionDelete()
    {
        if (!User::isAdmin()) {
            $_SESSION['message'] = "Вы не админ!";
            header('Location: /posts');
            exit();
        }


        $id = $_GET['id'];
        $post = Post::getOne($id);
        $post->delete();
        $_SESSION['message'] = "Пост удален";
        header('Location: /posts');
    }

    public function actionShow()
    {

        $id = (int)$_GET['id'];
        $user = User::getOne($id);

        echo $this->render('users/user', [
            'user' => $user
        ]);
    }


}