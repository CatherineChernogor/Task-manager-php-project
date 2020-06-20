<?php

namespace App\Models;

class Order extends BaseModel
{

    public $subject;
    public $type;
    public $place;
    public $date_start;
    public $date_end;
    public $comment;

    protected static $types = [
        'Дело',
        'Встреча',
        'Совещание',
        'Звонок',
    ];

    protected static $table = 'orders';

    protected static $attributes = [
        'subject',
        'type',
        'place',
        'date_start',
        'date_end',
        'comment',
    ];


    public static function list_types()
    {
        return static::$types;
    }

    public function validate()
    {
        if (empty($this->type)) {
            $this->errors['type'] = 'Не выбран тип';
        }

        if (empty($this->date_start)) {
            $this->errors['date_start'] = 'Не выбрана дата начала';
        }
        if (empty($this->date_end)) {
            $this->errors['date_end'] = 'Не выбрана дата окончания';
        }

        if (empty($this->subject)) {
            $this->errors['subject'] = 'Не выбрана тема';
        }

        return !$this->has_errors();
    }
}
