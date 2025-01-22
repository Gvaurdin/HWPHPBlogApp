<?php

namespace App\Blog\traits;

use App\Blog\core\Db;

trait TSingletone
{
    private static ?Db $instance = null;

    // сделали приватный конструктор , чтобы закрыть класс Db из вне
    // реализация паттерна singleton ( является антипаттерном
    private function __construct() { }
    private function __clone() { }

    public static function getInstance(): Db
    {
        if(is_null(self::$instance)) {
            static :: $instance = new static();
        }
        return self::$instance;
    }
}