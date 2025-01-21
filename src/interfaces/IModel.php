<?php

namespace App\Blog\interfaces;

interface IModel
{
    public function getOne(int $id);
    public function getAll();
}