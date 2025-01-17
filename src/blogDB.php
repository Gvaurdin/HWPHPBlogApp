<?php

function addPostDB() : string
{
    $db =getDB();
    //считываем пост и имя автора поста
    $title = getInput("Введите заголовок поста: ", "Заголовок не может быть пуст");
    $body = getInput("Введите текст поста: ", "Пост не может быть пустым");
    $nameAuthor = getInput("Введите имя автора поста: ", "Имя не может быть пустым");
    $surnameAuthor = getInput("Введите фамилию автора поста: ", "Фамилия не может быть пустой");

    //проверяем существует ли юзер с таким именем
    $stmt = $db->prepare("select id from users where name = :name");
    $stmt->execute([":name" => $nameAuthor]);
    $user = $stmt->fetch();

    //если такого юзера нет, создаем с его с типом автор
    if(!$user) {
        //проверяем категорию автор в таблице типы юзеров
        $stmt = $db->prepare("select id from UserTypes where userCategory = :category");
        $stmt->execute(['category' => 'Author']);
        $userType = $stmt->fetch();

        if (!$userType) {
            errorHandle("Нет категории пользователя : {$userType}");
        }
        $userTypeID = $userType["id"];

        //создаем юзера
        $stmt = $db->prepare("insert into Users (name,surname,id_userType) 
                                values (:name, :surname, :id_userType)");
        $stmt->execute([
            'name' => $nameAuthor,
            'surname' => $surnameAuthor,
            'id_userType' => $userTypeID
        ]);

        $userID = $db->lastInsertId();
    }else {
        $userID = $user["id"];
    }

    //проверяем заголовок поста (нет ли уже таких же в БД)
    $titleTrim = trim($title);
    $stmt = $db->prepare("select id from posts where TRIM(title) = :title");
    $stmt->execute(['title' => $titleTrim]);
    $existingPost = $stmt->fetch();
    if ($existingPost) {
        errorHandle("Пост с заголовком {$titleTrim} уже существует в БД");
    }

    //наконец то добавляем пост в БД
    $stmt = $db->prepare("insert into POSTS (title,text,id_user) values (:title,:text,:id_user)");
    $stmt->execute([
        'title' => $titleTrim,
        'text' => $body,
        'id_user' => $userID
    ]);
    return "Пост добавлен(БД)" .PHP_EOL;
}



function readAllPostsDB(): string
{
    $db =getDB();
    $stmt = $db->query("SELECT 
                                  p.id as post_id,
                                  p.title as post_title,
                                  p.text as post_text,
                                  u.name as user_name,
                                  u.surname as user_surname
                              FROM posts p
                              INNER JOIN Users u
                              ON p.id_user = u.id");
    $result = $stmt->fetchAll();

    //проверка, что посты есть
    if(empty($result)) {
        errorHandle("Походу постов в БД нет!");
    }

    //формируем вывод
    $output = "Все посты из БД:" .PHP_EOL;

    return printPost($result, $output);
}

function readPostDB($id) : string
{
    $db =getDB();
    $stmt = $db->prepare("SELECT                               
                              p.id AS post_id,
                              p.title AS post_title,
                              p.text AS post_text,
                              p.id_user AS post_user_id,
                              u.id AS user_id,
                              u.name AS user_name,
                              u.surname AS user_surname 
                               FROM posts p
                               INNER JOIN Users u
                               ON p.id_user = u.id
                               WHERE p.id = :id");
    $stmt->execute(["id" => $id]);
    $result = $stmt->fetch();

    if(!$result){
        errorHandle("Пост с ID:{$id} не найден в БД");
    }
    return "Найден следующий пост(БД):". PHP_EOL .print_r($result,true) . PHP_EOL;
}

function searchPostDB(string $search) : string
{
    $db =getDB();

    //готовим sql запрос, используем оператор like для поиска по заголовку и тексту поста
    $stmt = $db->prepare("select
                                    p.id as post_id,
                                    p.title as post_title,
                                    p.text as post_text,
                                    u.name as user_name,
                                    u.surname as user_surname
                                from posts p
                                inner join Users u
                                on p.id_user = u.id
                                where p.title LIKE :search OR p.text LIKE :search");
    //привязываем параметр поиска, добавляем % для поиска подстроки
    $searchTerm = "%" . $search . "%";
    $stmt->execute(['search' => $searchTerm]);
    $result = $stmt->fetchAll();
    // проверка, что пост(ы) нашлись
    if(empty($result)) {
        errorHandle("Посты по указанному поисковому слову : {$search} не найдены");
    }

    //формируем вывод
    $output = "Посты по запросу : {$search} : " .PHP_EOL;
    return printPost($result, $output);
}

function deletePostDB($id) : string
{
    $db =getDB();

    //проверяем, что пост с указанным айди существует
    $stmt =$db->prepare("select id from posts where id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();
    if(!$result){
        errorHandle("Пост с ID: {$id} не найден в базе данных");
    }
    //удаляем пост
    $deleteStmt = $db->prepare("delete from posts where id = :id");
    $deleteStmt->execute(['id' => $id]);
    return "Пост c ID: {$id} успешно удален(БД)" . PHP_EOL;
}

function clearPostsDB() : string
{
    $db =getDB();

    // начинаем транзакцию как серьезные парни
    $db->beginTransaction();

    //удаляем все посты из таблицы
    $db->exec("delete from posts");

    //сбрасываем автоинкремент таблицы постов
    $db->exec("delete from sqlite_sequence where name='POSTS'");

    //фиксируем транзакцию
    $db->commit();

    return "Все посты очищены(БД)" . PHP_EOL;
}
