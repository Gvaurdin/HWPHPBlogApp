<?php

namespace App\Blog;

use PDO;

Class DB
{
    static function initDB(): string
    {
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
        $db->query("CREATE TABLE IF NOT EXISTS Accounts (
    id INTEGER PRIMARY key AUTOINCREMENT unique,
    login varchar(50) NOT NULL,
    password_hash varchar(255) NOT NULL,
    id_userType INTEGER,
    id_user INTEGER,
    foreign key (id_userType) references UserTypes(id) on delete cascade on update cascade,
    foreign key (id_user) references Users(id) on delete cascade on update cascade
    );");
        return "Структура БД построена" . PHP_EOL;
    }

    static function seedDB(): string
    {
        $db = getDB();

        // Включаем поддержку внешних ключей
        $db->exec("PRAGMA foreign_keys = ON;");

        // Заполняем таблицу UserTypes
        $db->exec("
        INSERT OR IGNORE INTO UserTypes (id, userCategory) VALUES
        (1, 'Author'),
        (2, 'User'),
        (3, 'Admin');
    ");

        // Заполняем таблицу UsersController
        $db->exec("
        INSERT OR IGNORE INTO Users (id, name, surname, id_userType) VALUES
        (1, 'John', 'Gordon', 1),
        (2, 'Maria', 'Shark', 2),
        (3, 'Mike', 'Johnson', 1);
    ");

        // Заполняем таблицу Posts
        $db->exec("
        INSERT OR IGNORE INTO Posts (id, title, text, id_user) VALUES
        (1, 'Sport football', 'This post about sport', 1),
        (2, 'News world', 'This post about news of world', 3),
        (3, 'New car', 'This post about new cars', 1);
    ");

        // Заполняем таблицу Accounts (пароли уже захешированы)
        $db->exec("
        INSERT OR IGNORE INTO Accounts (id, login, password_hash, id_userType, id_user) VALUES
        (1, 'johng', '" . password_hash('password123', PASSWORD_DEFAULT) . "', 1, 1),
        (2, 'mariash', '" . password_hash('mypassword', PASSWORD_DEFAULT) . "', 2, 2),
        (3, 'mikej', '" . password_hash('securepass', PASSWORD_DEFAULT) . "', 1, 3);
    ");

        return "Данные успешно внесены в БД" . PHP_EOL;
    }

}
function getDB(): PDO
{
    static $dbPath = __DIR__ . '/../db/sqlDB/database.db';
    static $db = null;
    if (is_null($db)) {
        $db = new PDO("sqlite:" . $dbPath);
        // Устанавливаем режим выборки по умолчанию для PDO: данные будут возвращаться в виде ассоциативных массивов,
        // где ключами являются названия столбцов из базы данных. Это упрощает доступ к данным и делает код более читаемым.
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $db;
}
