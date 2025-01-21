<?php


namespace App\Blog\model;

use App\Blog\core\Db;
use App\Blog\interfaces\IModel;

abstract class Model implements IModel
{
    protected Db $db;
    abstract protected function getTableName(): string;

    protected array $queryConditions = []; // массив условий запроса

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

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
        $tableName = $this->getTableName();
        // соединяем условия через AND
        $conditions = implode(' AND ', $this->queryConditions);
        $sql = "SELECT * FROM {$tableName}";
        //если есть условия - добавляем в запрос
        if(!empty($conditions))
        {
            $sql .= " WHERE {$conditions}";
        }

        //выполняем запрос и возвращаем результат
        return $this->db->queryAll($sql);
    }

    public function getOne(int $id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }
}