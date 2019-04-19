<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App
 */
class User extends Model
{

    const SALT = 'stu';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

}
