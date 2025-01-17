<?php

function getDB(): PDO
{
    static $dbPath = __DIR__ . '/../db/sqlDB/database.db';
    static $db =null;
    if(is_null($db)){
        $db = new PDO("sqlite:" . $dbPath);
        // Устанавливаем режим выборки по умолчанию для PDO: данные будут возвращаться в виде ассоциативных массивов,
        // где ключами являются названия столбцов из базы данных. Это упрощает доступ к данным и делает код более читаемым.
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $db;
}
function initDB(): string
{
    # SQLite
    $db = getDB();
    $db->query("pragma foreign_keys = on;");
    $db->query("CREATE TABLE IF NOT EXISTS UserTypes (
    id INTEGER PRIMARY KEY AUTOINCREMENT unique,
    userCategory varchar(50) NOT NULL
    );");
    $db->query("CREATE TABLE IF NOT EXISTS POSTS (
    id INTEGER PRIMARY KEY AUTOINCREMENT unique,
    title varchar(50) NOT NULL,
    text TEXT NOT NULL,
    id_user INTEGER,
    foreign key (id_user) references Users(id) on delete cascade on update cascade
    );");
    $db->query("CREATE TABLE IF NOT EXISTS Users (
    id INTEGER PRIMARY key AUTOINCREMENT unique,
    name varchar(50) NOT NULL,
    surname varchar(50) NOT NULL,
    id_userType INTEGER,
    foreign key (id_userType) references UserTypes(id) on delete cascade on update cascade
    );");
    return "Структура БД построена".PHP_EOL;
}

function seedDB(): string
{
    $db = getDB();
//    $db->query("pragma foreign_keys = on;");
//    $db->query("INSERT INTO UserTypes (userCategory) VALUES('Author');");
//    $db->query("INSERT INTO UserTypes (userCategory) VALUES('User');");
//    $db->query("INSERT INTO UserTypes (userCategory) VALUES('Admin');");
//
//    $db->query("INSERT INTO Users (name, surname, id_userType) VALUES ('John', 'Gordon',1);");
//    $db->query("INSERT INTO Users (name, surname, id_userType) VALUES ('Maria', 'Shark',2);");
//    $db->query("INSERT INTO Users (name, surname, id_userType) VALUES ('Mike', 'Johnson',1);");
//
//    $db->query("INSERT INTO POSTS (title,text,id_user) VALUES ('Sport football', 'This post about sport', 1);");
//    $db->query("INSERT INTO POSTS (title,text,id_user) VALUES ('News world', 'This post about news of world',3);");
//    $db->query("INSERT INTO POSTS (title,text,id_user) VALUES ('New car', 'This post about new cars',1);");

    //данные для вставки
    $userTypes = [
        ['Author'],
        ['User'],
        ['Admin']
    ];

    $users = [
        ['John','Gordon',1],
        ['Maria','Shark',2],
        ['Mike',"Johnson",1],
    ];

    $posts = [
        ['Sport football', 'This post about sport', 1],
        ['News world', 'This post about news of world',3],
        ['New car', 'This post about new cars',1]
    ];

    // вставляем данные

    /*
     * команда exec используется для выполнения sql-запрсоов, которые
     * не возравщают набор данных. Команда возрващает только кол-во строк
     * затронутых sql запросом или 0
     */

    foreach ($userTypes as $type) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM UserTypes WHERE userCategory = :userCategory");
        $stmt->execute($type);
        if ($stmt->fetchColumn() == 0) {
            $insert = $db->prepare("INSERT INTO UserTypes (userCategory) VALUES (:userCategory)");
            $insert->execute($type);
        }
    }

    foreach ($users as $user) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM Users WHERE name = :name AND surname = :surname AND id_userType = :id_userType");
        $stmt->execute($user);
        if ($stmt->fetchColumn() == 0) {
            $insert = $db->prepare(
                "INSERT INTO Users (name, surname, id_userType) VALUES (:name, :surname, :id_userType)"
            );
            $insert->execute($user);
        }
    }

    foreach ($posts as $post) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM Posts WHERE title = :title AND text = :text AND id_user = :id_user");
        $stmt->execute($post);
        if ($stmt->fetchColumn() == 0) {
            $insert = $db->prepare("INSERT INTO Posts (title, text, id_user) VALUES (:title, :text, :id_user)");
            $insert->execute($post);
        }
    }

    return "Данные успешно внесены в БД".PHP_EOL;
}
