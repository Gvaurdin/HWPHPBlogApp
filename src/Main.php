<?php

namespace App\Blog;
use App\Blog\Helpers as Helpers;
use App\Blog\Blog as Blog;
use App\Blog\BlogDB as BlogDB;
use App\Blog\DB as DB;

Class Main
{
    public static function main(): string
    {
        $commandArray = parseCommand();
        $clasName = $commandArray[0];
        $methodName = $commandArray[1];
        $argument = $_SERVER['argv'][2] ?? null;

        // проверяем, есть ли у фукнции аргументы
        if(empty($argument)) {
            $result = $clasName::$methodName();
        } else {
            $result = $clasName::$methodName($argument); // передаем аргументы как параметры
        }
        return $result;
    }

}

function parseCommand(): array
{
    return match ($_SERVER['argv'][1] ?? null) {
        'add-post' => [Blog::class, 'addPost'], // FQCN и метод
        'read-all' => [Blog::class, 'readAllPosts'],
        'read-post' => [Blog::class, 'readPost'],
        'search-post' => [Blog::class, 'searchPost'],
        'delete-post' => [Blog::class, 'deletePost'],
        'clear-posts' => [Blog::class, 'clearPosts'],
        'init' => [DB::class, 'initDB'],
        'seed' => [DB::class, 'seedDB'],
        'add-post-db' => [BlogDB::class, 'addPostDB'],
        'read-post-db' => [BlogDB::class, 'readPostDB'],
        'read-all-db' => [BlogDB::class, 'readAllPostsDB'],
        'search-post-db' => [BlogDB::class, 'searchPostDB'],
        'delete-post-db' => [BlogDB::class, 'deletePostDB'],
        'clear-posts-db' => [BlogDB::class, 'clearPostsDB'],
        default => [Helpers::class, 'handleHelp'],
    };
}

/*
 * вместо строки 'Blog' используется Blog::class,
 *  который автоматически подставляет полное пространство имён: App\Blog\имя-класса
*/