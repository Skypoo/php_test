<?php


namespace App\Repository;


use App\Models\Student;

class StudentRepository
{
    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function createStudent($data)
    {
        $this->student->create($data);
    }

    public function checkStudent($student_id)
    {
        return $this->student
            ->where('student_id', $student_id)
            ->where('enable', 1)
            ->first();
    }

    public function deleteStudent($student_id)
    {
        $this->student
            ->where('student_id', $student_id)
            ->update(['enable' => 0]);
    }
}
