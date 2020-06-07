<?php


namespace App\Repository;


use App\Models\Teacher;

class TeacherRepository
{
    private $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function createTeacher($data)
    {
        $this->teacher->create($data);
    }

    public function checkTeacher($teacher_id)
    {
        return $this->teacher
            ->where('teacher_id', $teacher_id)
            ->where('enable', 1)
            ->first();
    }

    public function deleteTeacher($teacher_id)
    {
        $this->teacher
            ->where('teacher_id', $teacher_id)
            ->update(['enable' => 0]);
    }
}
