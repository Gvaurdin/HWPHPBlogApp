<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class Post extends Model
{
    public int $id;
    public string $title;
    public string $text;

    protected function getTableName(): string
    {
        return "POSTS";
    }
}