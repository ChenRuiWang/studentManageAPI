<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const SALT = 'stu';

    protected $fillable = ['username', 'password'];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

}
