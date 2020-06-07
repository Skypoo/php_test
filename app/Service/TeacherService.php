<?php


namespace App\Service;


use App\Repository\TeacherRepository;

class TeacherService
{
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function createTeacher($data)
    {
        $teacher_input = [
            'teacher_name'  => $data['name'],
            'email'         => $data['email']
        ];
        $this->teacherRepository->createTeacher($teacher_input);
    }

    public function checkTeacher($teacher_id)
    {
        return $this->teacherRepository->checkTeacher($teacher_id);
    }

    public function deleteTeacher($teacher_id)
    {
        $this->teacherRepository->deleteTeacher($teacher_id);
    }
}
