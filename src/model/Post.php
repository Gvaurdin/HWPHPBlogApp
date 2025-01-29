<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class Post extends Model
{
    protected int $id;
    protected string $title;
    protected string $text;

    protected int $id_user;
    protected $props =[
        'id' => false,
        'title' => false,
        'text' => false,
        'id_user' => false,
    ];

    protected static function getTableName(): string
    {
        return "POSTS";
    }

    public function __toString()
    {
        return "<div class='post'>"
            . "<h2>" . htmlspecialchars($this->title) . "</h2>"
            . "<p>" . nl2br(htmlspecialchars($this->text)) . "</p>"
            . "<p>" . "ID автора: " . htmlspecialchars($this->id_user) . "</p>"
            . "</div>";
    }
}