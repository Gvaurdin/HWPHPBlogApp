<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class User extends Model
{
    public int $id;
    public string $name;
    public string $surname;

    protected function getTableName(): string
    {
        return 'Users';
    }
}