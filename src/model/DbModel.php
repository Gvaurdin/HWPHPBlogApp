<?php

namespace App\Blog\model;

use App\Blog\core\Db;
use App\Blog\Helpers;
use App\Blog\interfaces\IModel;

//TODO реализовать универсальные update, delete

/**
 * @property int $id
 */
abstract class DbModel implements IModel
{
    abstract static protected function getTableName(): string;
    private array $queryConditions = []; // массив условий запроса

    public function query()
    {
        $this->queryConditions = []; // очищаем массив условий
        return $this;
    }

    public function where(string $column, string $value): static
    {
        $this->queryConditions[] = "$column = '$value'";
        return $this; // возвращаем текущий объект для построения цепочек
    }

    public function get()
    {
        $tableName = static::getTableName();
        // соединяем условия через AND
        $conditions = implode(' AND ', $this->queryConditions);
        $sql = "SELECT * FROM {$tableName}";
        //если есть условия - добавляем в запрос
        if(!empty($conditions))
        {
            $sql .= " WHERE {$conditions}";
        }

        //выполняем запрос и возвращаем результат
        return Db::getInstance()->queryAll($sql);
    }

    public static function getOne(int $id)
    {
        $table = static::getTableName();
        $sql = "select * from $table where id = :id" . PHP_EOL;
        return Db::getInstance()->queryOneObject($sql, ['id' => $id],static::class);

    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}" . PHP_EOL;
        return Db::getInstance()->queryAll($sql);
    }

    public function insert(): DbModel
    {
        $tableName = static::getTableName();
        [$fields,$placeholders,$values] = $this->prepareFieldsAndValues(false);


        $fieldsString = implode(', ', $fields);
        $placeholdersString = implode(', ', $placeholders);
        $sql = "insert into $tableName ($fieldsString) values ($placeholdersString)";

        Db::getInstance()->execute($sql, $values);

        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update(): bool
    {
        $tableName = static::getTableName();
        [$fields,$placeholders,$values] = $this->prepareFieldsAndValues(true);

        $fieldsString = implode(', ', $fields);
        $values[] = $this->id;
        $sql = "update $tableName set $fieldsString where id = ?";

        //возвращаем количество строк, затронутых выполнением запроса
        //если rowCount > 0  - true : false
        return Db::getInstance()->execute($sql, $values)->rowCount() > 0;
    }


    protected function prepareFieldsAndValues(bool $isUpdate = false): array
    {
        $fields = [];
        $placeholders = [];
        $values = [];

        foreach ($this as $field => $value)
        {
            if(is_array($value)) continue;

            if($isUpdate)
            {
                if(isset($this->props[$field]) && $this->props[$field])
                {
                    $fields[] = "`$field` = ?";
                    $values[] = $value;
                }
            }else
            {
                $fields[] = $field;
                $placeholders[] = '?';
                $values[] = $value;
            }

        }

        if($isUpdate && empty($fields))
        {
            Helpers::errorHandle("Нет изменений для обновления");
        }

        return [$fields, $placeholders, $values];

    }

}