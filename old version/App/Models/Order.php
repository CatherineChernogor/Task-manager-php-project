<?php

namespace App\Models;

class Order extends BaseModel
{
    public $subject;
    public $type;
    public $place;
    public $date_start;
    public $comment;
    public $date_end;


    protected static $types = [
        1 => 'Дело',
        2 => 'Встреча',
        3 => 'Звонок',
        4 => 'Совещание',

    ];

    protected static $table = 'Orders';

    protected static $attributes = [
        'subject',
        'type',
        'place',
        'date_start',
        'date_end',
        'comment',
    ];

    public static function getTypes()
    {
        return static::$types;
    }

    public function validate()
    {
        if (empty($this->type)) {
            $this->errors['type'] = 'Не выбран тип';
        }

        if (empty($this->date_start)) {
            $this->errors['date_start'] = 'Не выбрано время начала';
        }

        if (empty($this->subject)) {
            $this->errors['subject'] = 'Не введена тема';
        }
        if (empty($this->date_end)) {
            $this->errors['date_end'] = 'Не выбрано время конца';
        }

        return !$this->has_errors();
    }

    public function fill($array)
    {
        foreach (static::$attributes as $attribute) {
            $this->$attribute = array_get($array, $attribute);
        }
    }
}
