<?php

use App\Blog\controllers\HomeController as HomeController;
use App\Blog\controllers\PostsController as PostsController;
use App\Blog\controllers\UsersController as UsersController;

require __DIR__ . '/../vendor/autoload.php';

//$request = trim($_SERVER['REQUEST_URI'], '/');
//
//switch ($request)
//{
//    case '':
//        $homeController = new HomeController();
//        $homeController->index();
//        break;
//        case 'posts':
//            $postsController = new PostsController();
//            $postsController->index();
//            break;
//            case 'users':
//                $usersController = new UsersController();
//                $usersController->index();
//                break;
//                default:
//                    http_response_code(404);
//                    echo 'Page not found';
//                    break;
//
//
//}

$controllerName = $_GET['c'] ?? 'home';
$actionName = $_GET['a'] ?? 'index';
$id = $_GET['id'] ?? null;

$controllerClass = "App\\Blog\\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass))
{
    $controller = new $controllerClass();
    if($id !== null)
    {
        $controller->runAction($actionName,$id);
    } else
    {
        $controller->runAction($actionName);
    }
} else {
    echo "нет такого контроллера";
}
