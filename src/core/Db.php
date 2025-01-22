<?php

namespace App\Blog\core;

use App\Blog\config\Config;
use App\Blog\model\Model;
use App\Blog\traits\TSingletone;
use PDO;

class Db
{
    // конфиг БД
    private array $config = [
        'host' => 'localhost',
        'driver' => 'sqlite',
        'login' => '',
        'password' => '',
        'database' => '',
    ];

    use TSingletone;
    private ?\PDO $dbConnection = null; // \ - слеш для глобальной области видимости

    private function getConnection(): \PDO
    {
        if(is_null($this->dbConnection)) {
            $this->config['database'] = Config::getDatabasePath();
            $this->dbConnection = new \PDO("{$this->config['driver']}:{$this->config['database']}");
            $this->dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->dbConnection;
    }

    //select where id=:id, ['id' =>1]
    private function query(string $sql, array $params = []): false|\PDOStatement
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function lastInsertId() : int
    {
        return $this->getConnection()->lastInsertId();
    }

    public function execute(string $sql, array $params = []): \PDOStatement
    {
        return $this->query($sql, $params);
    }


    //Select where id = :id, ['id' => 1]
    public function queryOne(string $sql, array $params = []): ?array
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryOneObject(string $sql, array $params,string $class): Model
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        return $pdoStatement->fetch();
    }

    //select *
    public function queryAll($sql): bool|array
    {
        return $this->query($sql)->fetchAll();
    }
}