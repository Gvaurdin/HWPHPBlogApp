<?php


namespace App\Blog\model;

use App\Blog\Helpers;

abstract class Model extends DbModel
{

    public function __get(string $name): mixed
    {
        if(!array_key_exists($name, $this->props) || !$this->props[$name])
        {
            Helpers::errorHandle("Нельзя читать значение поля '{$name}'");
        }
        return $this->$name;
    }

    public function __set(string $name,$value): void
    {
        if(!array_key_exists($name, $this->props))
        {
            Helpers::errorHandle("Нельзя писать в поле '{$name}'");
        }
        $this->$name = $value;
        $this->props[$name] = true;
    }

}