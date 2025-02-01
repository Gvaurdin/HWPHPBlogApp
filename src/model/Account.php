<?php

namespace App\Blog\model;

use App\Blog\core\Db;

class Account extends Model
{
    protected ?int $id = null;
    protected ?string $login;
    protected ?string $password_hash;

    protected ?int $id_user = null;

    protected ?int $id_userType = null;
    protected array $props =[
        'login' => false,
        'password_hash' => false,
        'id_user' => false,
        'id_userType' => false,
    ];

    //получаем тип пользователя
    public function getUserType(): ?string
    {
        // получаем роль из таблицы UsersTypes
        $userType = UserType::getOne($this->id_userType);
        return $userType ? $userType->userCategory : null;
    }

    // Проверка пароля
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }

    static protected function getTableName(): string
    {
        return 'Accounts';
    }
    public static function getOneByLogin(string $login): ?Account
    {
        $sql = "select * from " . static::getTableName() . " where login = :login";
        return Db::getInstance()->queryOneObject($sql, ["login" => $login], static::class);
    }

}