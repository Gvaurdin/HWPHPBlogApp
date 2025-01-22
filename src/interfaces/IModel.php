<?php

namespace App\Blog\interfaces;

interface IModel
{
    public static function getOne(int $id);
    public function getAll();

    public function insert();
}