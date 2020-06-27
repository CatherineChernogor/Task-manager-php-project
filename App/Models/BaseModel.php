<?php

namespace App\Models;

use App\Database;

abstract class BaseModel
{

    public $id;

    protected static $table;
    protected static $attributes = [];

    protected $errors = [];


    public function validate()
    {
        return true;
    }

    public function save()
    {
        if ($this->validate()) {
            $sql = static::get_pdo()->prepare('INSERT INTO `' . static::$table . '` (`' . implode('`, `', static::$attributes) . '`) VALUES (:' . implode(', :', static::$attributes) . ');');

            $data = [];

            foreach (static::$attributes as $attribute) {
                $data[$attribute] = $this->$attribute;
            }

            $sql->execute($data);

            return $sql->rowCount() === 1;
        }

        return false;
    }

    public function update()
    {
        if ($this->id && $this->validate()) {
            $set = [];

            foreach (static::$attributes as $attribute) {
                $set[] = '`' . $attribute . '` = :' . $attribute;
            }

            $sql = static::get_pdo()->prepare('UPDATE `' . static::$table . '` SET ' . implode(', ', $set) . ' WHERE id = :id LIMIT 1;');

            $data = [];

            foreach (static::$attributes as $attribute) {
                $data[$attribute] = $this->$attribute;
            }

            $data['id'] = $this->id;

            $sql->execute($data);

            return $sql->errorInfo();
        }

        return false;
    }

    public static function delete_by_id($id)
    {
        $sql = static::get_pdo()->prepare('DELETE FROM `' . static::$table . '` WHERE id = :id LIMIT 1;');

        $data = [];
        $data['id'] = $id;

        $sql->execute($data);

        return $sql->errorInfo();
    }

    protected static function get_pdo()
    {
        return Database::get_pdo();
    }


    public function has_errors()
    {
        return !empty($this->errors);
    }

    public function get_error($field_name)
    {
        return array_get($this->errors, $field_name);
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function fill($array)
    {
        foreach (static::$attributes as $attribute) {
            $this->$attribute = array_get($array, $attribute);
        }
        $this->id = $array['id'] ?? '';
    }


    public static function get_all()
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '`;');
        $sql->execute();

        $objects = [];

        while ($object = $sql->fetchObject(static::class)) {
            $objects[] = $object;
        }

        return $objects;
    }

    public static function get_by_id($id)
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '` WHERE id = :id LIMIT 1;');
        $sql->execute(['id' => $id]);
        $object = $sql->fetchObject(static::class);
        return $object;
    }
}
