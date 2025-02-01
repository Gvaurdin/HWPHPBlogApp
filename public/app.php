<?php

use App\Blog\controllers\HomeController as HomeController;
use App\Blog\controllers\PostsController as PostsController;
use App\Blog\controllers\UsersController as UsersController;
use App\Blog\core\Render;



require __DIR__ . '/../vendor/autoload.php';

session_start();

$controllerName = $_GET['c'] ?? 'home';
$actionName = $_GET['a'] ?? 'index';

$controllerClass = "App\\Blog\\controllers\\" . ucfirst($controllerName) . "Controller";

try {
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        throw new Exception("Нет такого контроллера");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


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