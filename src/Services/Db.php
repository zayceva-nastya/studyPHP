<?php

namespace Services;

use Exeptions\DbExeption;

class Db
{
    private $pdo;
    private static $instance;

    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];
        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\Exception $e) {
            throw new DbExeption('Ошибка подключения к БД:' . $e->getMessage());
        }

    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

}