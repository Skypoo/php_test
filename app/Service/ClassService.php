<?php


namespace App\Service;


use App\Repository\ClassRepository;

class ClassService
{
    private $classRepository;

    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function createClass($data)
    {
        $class_input = [
            'class_name'    => $data['name'],
            'class_time'    => $data['class_time'],
            'day'           => $data['day']
        ];
        $this->classRepository->createClass($class_input);
    }

    public function checkClass($class_id)
    {
        return $this->classRepository->checkClass($class_id);
    }

    public function deleteClass($class_id)
    {
        $this->classRepository->deleteClass($class_id);
    }

    public function createElectives($data)
    {
        $this->classRepository->createClassMember($data);
    }

    public function deleteElectives($class_id, $student_id)
    {
        $this->classRepository->deleteElectives($class_id, $student_id);
    }

    public function modifyClassTeacher($class_id, $teacher_id)
    {
        $this->classRepository->modifyClassTeacher($class_id, $teacher_id);
    }

    public function getClassInfo($class_id)
    {
        $class_info = $this->classRepository->getClassInfo($class_id);

        $data = array();

        if ($class_info) {
            $data['class_id'] = $class_info['class_id'];
            $data['class_name'] = $class_info['class_name'];
            $data['teacher_id'] = $class_info['teacher_id'];
            $data['class_time'] = $class_info['class_time'];
            $data['day'] = $class_info['day'];
            $data['teacher_name'] = ($class_info['teacher_id']) ? $class_info['relationTeacher']['teacher_name'] : null;
        }

        return $data;
    }

    public function getClassMember($class_id)
    {
        $class_member = $this->classRepository->getClassMember($class_id);

        $data = array();

        if ($class_member->count()) {
            foreach ($class_member as $key => $value) {
                $student_member['student_id'] = $value['student_id'];
                $student_member['student_name'] = $value['relationStudent']['student_name'];
                $data[$key] = $student_member;
            }
        }

        return $data;
    }
}
