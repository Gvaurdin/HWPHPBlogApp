<?php

namespace App\Blog\model;

class UserType extends Model
{
    public int $id;
    public string $userCategory;

    protected function getTableName(): string
    {
        return 'UserTypes';
    }
}