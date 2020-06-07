<?php


namespace App\Repository;


use App\Models\ClassInfo;
use App\Models\ClassMember;
use Illuminate\Support\Facades\DB;

class ClassRepository
{
    private $classInfo;
    private $classMember;

    public function __construct(ClassInfo $classInfo, ClassMember $classMember)
    {
        $this->classInfo = $classInfo;
        $this->classMember = $classMember;
    }

    public function createClass($data)
    {
        $this->classInfo->create($data);
    }

    public function modifyClassTeacher($class_id, $teacher_id)
    {
        $this->classInfo
            ->where('class_id', $class_id)
            ->update(['teacher_id' => $teacher_id]);
    }

    public function checkClass($class_id)
    {
        return $this->classInfo
            ->where('class_id', $class_id)
            ->where('enable', 1)
            ->first();
    }

    public function deleteClass($class_id)
    {
        $this->classInfo
            ->where('class_id', $class_id)
            ->update(['enable' => 0]);
    }

    public function createClassMember($data)
    {
        $this->classMember->create($data);
    }

    public function deleteElectives($class_id, $student_id)
    {
        $this->classMember
            ->where('class_id', $class_id)
            ->where('student_id', $student_id)
            ->update(['enable' => 0]);
    }

    public function getClassInfo($class_id)
    {
        return $this->classInfo
            ->with('relationTeacher')
            ->where('class_id', $class_id)
            ->first();
    }

    public function getClassMember($class_id)
    {
        return $this->classMember
            ->with(['relationStudent' => function($query) {
                $query->where('enable', 1);
            }])
            ->with('relationClassInfo')
            ->where('class_id', $class_id)
            ->where('enable', 1)
            ->get();
    }
}
