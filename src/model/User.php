<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class User extends Model
{
    public ?int $id;
    public ?string $name;
    public ?string $surname;

    public function __construct(string $name = null, string $surname = null)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

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