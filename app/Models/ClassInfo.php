<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassInfo extends Model
{
    protected $table = 'class_info';
    protected $primaryKey = 'class_id';
    protected $fillable = [
        'class_name',
        'teacher_id',
        'class_time',
        'day'
    ];

    public function relationTeacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'teacher_id');
    }

    public function relationClassMember()
    {
        return $this->hasMany('App\Models\ClassMember', 'class_id', 'class_id');
    }

}
