<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class User extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $surname;

    protected ?int $id_userType;

    protected array $props =[
        'id' => false,
        'name' => false,
        'surname' => false,
        'id_userType' => false,
    ];

    public function __construct(string $name = null, string $surname = null)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public static function getName()
    {
        return $_SESSION['login'] ?? false;
    }

    public static function isAdmin(): bool
    {
        return $_SESSION['login'] === 'admin';
    }

    //с помощью функции test мы получаем список публичных полей класса
    public function test()
    {
        foreach ($this as $key => $value) {
            echo $key . " => " . $value . "\n";
        }
    }

    public function insertUser(): User
    {
        $sql = "insert into Users (name,surname) values (?, ?)";
        Db::getInstance()->execute($sql, [$this->name, $this->surname]);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    protected static function getTableName(): string
    {
        return 'Users';
    }


}