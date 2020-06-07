<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $fillable = [
        'teacher_name',
        'email',
        'enable'
    ];
}
