<?php

namespace App\Blog\model;

class Comment extends Model
{
    public int $id;
    public string $commentText;
    public int $postId;
    public int $userId;
    protected static function getTableName(): string
    {
        return 'Comments';
    }
}