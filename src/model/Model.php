<?php


namespace App\Blog\model;

//TODO 2* Реализовать универсальный insert для всех моделей
use App\Blog\core\Db;
use App\Blog\interfaces\IModel;

abstract class Model implements IModel
{
    protected Db $db;
    abstract static protected function getTableName(): string;

//    private array $queryConditions = []; // массив условий запроса

//    public function __construct()
//    {
//        $this->db = DB::getInstance();
//    }

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
        return $this->db->queryAll($sql);
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

    public function insert(): Model
    {
        $tableName = static::getTableName();
        $fields = [];
        $placeholders = [];
        $values = [];

        foreach ($this as $field => $value)
        {
            //пропускаем поле айди и нулл значения
            if($field !== 'id' && $value !== null )
            {
                $fields[] = $field;
                $placeholders[] = '?';
                $values[] = $value;
            }
        }

        $fieldsString = implode(', ', $fields);
        $placeholdersString = implode(', ', $placeholders);
        $sql = "insert into $tableName ($fieldsString) values ($placeholdersString)";

        Db::getInstance()->execute($sql, $values);

        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

}