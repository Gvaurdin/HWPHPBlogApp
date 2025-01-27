<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class Post extends Model
{
    protected int $id;
    protected string $title;
    protected string $text;
    protected $props =[
        'id' => false,
        'title' => false,
        'text' => false,
    ];

    protected static function getTableName(): string
    {
        return "POSTS";
    }
}