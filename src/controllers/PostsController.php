<?php

namespace App\Blog\controllers;

use App\Blog\Helpers;
use App\Blog\model\Post as Post;
use http\Client\Curl\User;

class PostsController extends Controller
{

    public function actionIndex()
    {
        $posts = Post::getAll();

        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        echo $this->render('posts/index', [
            'posts' => $posts,
            'message' => $message
        ]);
    }

    public function actionSave()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $id_user = $_POST['id_user'];


        $_SESSION['message'] = null;


        if (empty($title) || empty($text) || empty($id_user)) {
            $_SESSION['message'] = "All fields are required";
            header('Location: /?c=posts');
            exit;
        }


        $post = new Post($title, $text,$id_user);
        $post->save();


        $_SESSION['message'] = "Post saved";
        header('Location:/?c=posts');

    }

    public function actionDelete()
    {
//        if (!User::isAdmin()) {
//            $_SESSION['message'] = "Вы не админ!";
//            header('Location: /posts');
//            exit();
//        }


        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['message'] = "Invalid post ID";
            header('Location: /?c=posts');
            exit;
        }

        $post = Post::getOne($id);

        if (!$post) {
            $_SESSION['message'] = "Post not found";
            header('Location: /?c=posts');
            exit;
        }

        $post->delete();
        $_SESSION['message'] = "Пост удален";
        header('Location: /?c=posts');
    }

    public function actionShow()
    {

        $id = (int)$_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['message'] = "Invalid post ID";
            header('Location: /?c=posts');
            exit;
        }

        $post = Post::getOne($id);

        if (!$post) {
            $_SESSION['message'] = "Post not found";
            header('Location: /?c=posts');
            exit;
        }

        echo $this->render('posts/post', [
            'post' => $post
        ]);
    }



}