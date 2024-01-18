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
        $db = Db::getInstance();

        $entities = $db->query(
            "Select * from `" . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public static function findAll()
    {
        $db = Db::getInstance();

        return $db->query(
            "Select * from `" . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();

        if ($this->id != null) {
            $this->update($mappedProperties);
        }
        $this->insert($mappedProperties);
    }

    private function update($mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $columns => $value) {
            $param = ":param" . $index;
            $columns2params[] = $columns . "=" . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = "UPDATE " . static::getTableName() . " SET " .
            implode(',', $columns2params) .
            " WHERE id=" . $this->id;
        $db = DB::getInstance();
        $db->query($sql, $params2values, static::class);

    }

    private function insert($mappedProperties): void
    {
        $filtermappedProperties = array_filter($mappedProperties);
        $collumens = [];
        $paramsName = [];
        $params2values = [];

        foreach ($filtermappedProperties as $key => $value) {
            $collumens[] = '`' . $key . '`';
            $paramName = ":" . $key;
            $paramsName[] = $paramName;
            $params2values[$paramName] = $value;

        }

        $sql = "INSERT INTO " . static::getTableName() .
            " (" . implode(',', $collumens) . ")" .
            " VALUES (" . implode(',', $paramsName) . ")";
        var_dump($sql);
        $db = DB::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();

    }


    public function delete()
    {
        if ($this->id === null) {
            echo "no such id";
        }
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        var_dump(static::getById($this->id));
//        $this->id = null;
//        var_dump(static::getById($this->id));

    }

    public function refresh()
    {
        $object = static::getById($this->id);
        $reflector = new \ReflectionObject($object);
        foreach ($reflector->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($object);

        }

    }

    public function camelCasesToUnderscore($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }

    private function mapPropertiesToDbFormat()
    {
        $reflect = new \ReflectionObject($this);
        $properties = $reflect->getProperties();

        $mappedProperties = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCasesToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;

        }
        return $mappedProperties;
    }

    abstract protected static function getTableName(): string;

    public static function findDublicate(string $columnName, $value): ?self
    {
        $db = DB::getInstance();
        $result = $db->query('SELECT * From `' . static::getTableName() . '` WHERE `' . $columnName . '` =:value LIMIT 1;',
            [':value' => $value],
            static::class
        );

        if ($result === []) {
            return null;
        }
        return $result[0];


    }

}