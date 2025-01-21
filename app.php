<?php

//require_once 'src/blog.php';
//require_once 'src/helpers.php';
//require_once 'src/main.php';



require "vendor/autoload.php";
//----------------------------------------BlogApp----------------------------------------------------------
//use App\Blog\Main as Main;
//
//
//try {
//    $result = Main::main();
//    echo $result . PHP_EOL;
//} catch (PDOException $pe) {
//    echo $pe->getMessage() . PHP_EOL;
//} catch (Exception $e){
//    echo $e->getMessage() . PHP_EOL;
//}
//----------------------------------------------------------------------------------------------------------

use App\Blog\core\Db;
use App\Blog\model\Post;
use App\Blog\model\User;

$db = new Db();
$post = new Post($db);
$user = new User($db);

echo $user->getOne(3) . PHP_EOL;
echo $post->getAll() . PHP_EOL;

// запрос с условием
echo $user->query()->where('name','John')->get() . PHP_EOL;
// запрос с цепочкой условий
echo $user->query()->where('name','John')->where('id_userType',1)->get() . PHP_EOL;

// подключили библиотеку faker через composer
//$faker = Faker\Factory::create('ru_Ru');
//echo $faker->name() . PHP_EOL;
