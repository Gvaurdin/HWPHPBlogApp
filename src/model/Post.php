<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class Post extends Model
{
    protected ?int $id = null;
    protected ?string $title;
    protected ?string $text;

    protected ?int $id_user = null;
    protected array $props =[
        'title' => false,
        'text' => false,
        'id_user' => false,
    ];

    public function __construct(string $title = null, string $text = null, int $id_user = null)
    {
        $this->title = $title;
        $this->text = $id_user;
    }
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