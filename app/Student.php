<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * @package App
 */
class Student extends Model
{
    /**
     * @var string
     */
    protected $table = 'students';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'number', 'sex', 'nation', 'born', 'cd_card', 'phone', 'avatar', 'enter_time', 'finish_time', 'edu', 'school_name', 'major_name'];
    /**
     * @var bool
     */
    public $timestamps = false;

    public function getBornAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getEnterTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getFinishTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}
