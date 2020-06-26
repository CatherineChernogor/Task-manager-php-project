<?php

namespace App\Models;

class Event extends BaseModel
{

    const STATUS_DONE = 1;
    const STATUS_PENDING = 0;

    const TYPE_TASK = 'task';
    const TYPE_CALL = 'call';
    const TYPE_MEETING = 'meeting';
    const TYPE_APPOINTMENT = 'appointment';


    public $id;
    public $status = 0;
    public $subject;
    public $type;
    public $place;
    public $date_start;
    public $date_end;
    public $comment;


    protected static $table = 'events';

    protected static $attributes = [

        'status',
        'subject',
        'type',
        'place',
        'date_start',
        'date_end',
        'comment',
    ];


    public static function list_types()
    {
        return [
            static::TYPE_APPOINTMENT => 'Совещание',
            static::TYPE_CALL => 'Звонок',
            static::TYPE_MEETING => 'Встреча',
            static::TYPE_TASK => 'Дело',
        ];
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

    public static function get_all_pending()
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '` WHERE `status`= :status ORDER BY `date_end` desc;');
        $sql->execute(['status' => static::STATUS_PENDING,]);

        $objects = [];

        while ($object = $sql->fetchObject(static::class)) {
            $objects[] = $object;
        }

        return $objects;
    }

    public static function get_all_failed()
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '` WHERE `status`= :status and `date_end` < NOW() ORDER BY `date_end` desc;');
        $sql->execute(['status' => static::STATUS_PENDING,]);

        $objects = [];

        while ($object = $sql->fetchObject(static::class)) {
            $objects[] = $object;
        }

        return $objects;
    }
    public static function get_all_done()
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . static::$table . '` WHERE `status`= :status  ORDER BY `date_end` desc;');
        $sql->execute(['status' => static::STATUS_DONE,]);

        $objects = [];

        while ($object = $sql->fetchObject(static::class)) {
            $objects[] = $object;
        }

        return $objects;
    }

    public function set()
    {
        if ($this->is_new()) {

            $this->save();
        } else {

            $this->update();
        }
    }

    public function is_new()
    {
        return !$this->id;
    }

    public function get_texed_type()
    {
        $types = static::list_types();
        if (isset($types[$this->type])) {
            return $types[$this->type];
        }
        return '-';
    }

    public function is_done()
    {

        return $this->status == static::STATUS_DONE;
    }

    public function is_failed()
    {
        $time = strtotime($this->date_end);
        return $this->status == static::STATUS_PENDING && $time < time();
    }
}
