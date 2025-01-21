<?php

namespace App\Blog;

use InvalidArgumentException;

class Helpers{
    public static function errorHandle(string $error) : string
    {
        throw new InvalidArgumentException("\033[31m" . $error . "\r\n \033[97m");
    }

    public static function handleHelp(): string
    {
        return <<<HELP
Доступные команды
help - вывод данной подсказки
init - инициализация структуры БД
seed - внесение данных в таблицу БД
add-post-db - добавить пост в БД
read-all-db - прочитать все посты из БД
read-post-db id - прочитать пост из БД по айди
search-post-db searchWorld - найти пост(-ы) по поисковому слову
delete-post-db id - удалить пост из бд по айди 
clear-posts-db - удалить все посты из бд
add-post - создать новый пост
read-all-posts - прочитать все посты
read-post id - прочитать пост по айди
search-post searchWorld - найти пост по поисковому слову
delete-post id - удалить пост по айди
clear-posts - удалить все посты
HELP;

    }
}
