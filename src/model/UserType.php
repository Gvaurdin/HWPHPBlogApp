<?php

namespace App\Blog\model;

class UserType extends Model
{
    protected ?int $id = null;
    protected ?string $userCategory;

    protected array $props =[

        'userCategory' => false,
    ];

    protected static function getTableName(): string
    {
        return 'UserTypes';
    }
}