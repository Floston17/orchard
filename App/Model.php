<?php

namespace App;

use core\Container;

abstract class Model
{
    protected const TABLE = '';
    public int $id;

    /**
     * Selects all records.
     */
    public static function selectAll(): array
    {
        $statement = 'SELECT * FROM ' . static::TABLE;
        return Container::get('database')->query($statement, static::class);
    }

    /**
     * Inserts record into the table
     */
    public function insert(): bool
    {
        $data = [];
        $props = get_object_vars($this);

        if (array_key_exists('id', $props)) {
            unset($props['id']);
        }

        $statement = sprintf('INSERT INTO %s (%s) VALUES (%s)',
            static::TABLE,
            implode(', ', array_keys($props)),
            ':' . implode(', :', array_keys($props))
        );

        foreach ($props as $key => $value) {
            $data[':' . $key] = $value;
        }

        return Container::get('database')->execute($statement, $data);
    }

    /**
     * Deletes all records in table
     */
    public static function deleteAll()
    {
        $statement = 'DELETE FROM ' . static::TABLE;
        Container::get('database')->execute($statement);
    }

    /**
     * Sets id equal to last database inserted id
     */
    public function setId()
    {
        $this->id = Container::get('database')->lastInsertId();
    }
}