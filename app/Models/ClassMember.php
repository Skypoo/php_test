<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    protected $table = 'class_member';
    protected $primaryKey = ['class_id', 'student_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'class_id',
        'student_id'
    ];

    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('class_id', $this->getAttribute('class_id'))
            ->where('student_id', $this->getAttribute('student_id'));
    }

    public function relationStudent()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'student_id');
    }

    public function relationClassInfo()
    {
        return $this->belongsTo('App\Models\ClassInfo', 'class_id', 'class_id');
    }
}
