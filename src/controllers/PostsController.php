<?php

namespace App\Blog\controllers;

use App\Blog\Helpers;
use App\Blog\views\Posts;
use App\Blog\core\Db;
use App\Blog\model\Post as Post;
class PostsController
{
    public function runAction($action, $id = null)
    {
        $method = 'action' . ucfirst($action);
        if(method_exists($this, $method))
        {
            if($id != null)
            {
                $this->$method($id);
            } else
            {
                $this->$method();
            }
        } else
        {
            Helpers::errorHandle("Action $action not found");
        }
    }
    public function actionIndex()
    {
        $posts = new Post();
        $view = new Posts();
        $view->render($posts->getAll());
    }

    public function actionPost($id)
    {

        $post = Post::getOne(1);
        $view = new Posts();
        $view->renderPost($post);
    }
}