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
            $this->errors['type'] = 'Не введено type';
        }

        if (empty($this->date_start)) {
            $this->errors['date_start'] = 'Не введен date_start';
        }
        if (empty($this->date_end)) {
            $this->errors['date_end'] = 'Не введен date_end';
        }

        if (empty($this->subject)) {
            $this->errors['subject'] = 'Не выбрана тема';
        }

        return !$this->has_errors();
    }
}
