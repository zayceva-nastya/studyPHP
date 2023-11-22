<?php

namespace Models;

use Services\Db;

abstract class ActiveRecordEntity
{

    private $id;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    protected function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getById(int $id)
    {
        $db = new Db();

        $entities = $db->query("Select * from `" . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findAll()
    {
        $db = new Db();

        return $db->query("Select * from `" . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    abstract protected static function getTableName(): string;
}