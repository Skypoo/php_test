<?php


namespace App\Service;


use App\Repository\StudentRepository;

class StudentService
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function createStudent($data)
    {
        $student_input = [
            'student_name'  => $data['name'],
            'email'         => $data['email']
        ];
        $this->studentRepository->createStudent($student_input);
    }

    public function checkStudent($student_id)
    {
        return $this->studentRepository->checkStudent($student_id);
    }

    public function deleteStudent($student_id)
    {
        $this->studentRepository->deleteStudent($student_id);
    }
}
