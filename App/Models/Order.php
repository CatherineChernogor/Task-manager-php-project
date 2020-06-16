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
        1 => 'Встреча',
        2 => 'Звонок',
        3 => 'Совещание',
        4 => 'Дело',
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
            $this->errors['type'] = 'Не введено type';
            echo 'type';
        }

        if (empty($this->date_start)) {
            $this->errors['date_start'] = 'Не введен date_start';
            echo 'date_start';
        }

        if (empty($this->subject)) {
            $this->errors['subject'] = 'Не выбрана тема';
            echo 'subject';
        }
        if (empty($this->date_end)) {
            $this->errors['date_end'] = 'Не выбрана date_end';
            echo 'date_end';
        }
        var_dump($this);
        var_dump(!$this->has_errors());
        return !$this->has_errors();
    }

    public function fill($array)
    {
        foreach (static::$attributes as $attribute) {
            $this->$attribute = array_get($array, $attribute);
        }
    }
}
