<?php

namespace App\Blog\interfaces;

interface IModel
{
    public static function getOne(int $id);
    public static function getAll();

    public function insert();
}