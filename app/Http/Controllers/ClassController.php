<?php

namespace App\Http\Controllers;

use App\Service\ClassService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClassController extends Controller
{
    private $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function create(Request $request)
    {
        $format = [
            'name'          => 'required|string',
            'class_time'    => 'required|date_format:H:i:s',
            'day'           => 'required|integer|between:1,7'
        ];

        try {
            $this->checkFormat($request, $format);
            $this->classService->createClass($request->all());

            return $this->responseSuccess();
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                $message = $e->getTrace()[0]['args'][0];
            } else {
                $message = $e->getMessage();
            }
            $info = [
                'status' => 'E02',
                'message' => $message
            ];

            return response()->json($info);
        }
    }

    public function modifyClassTeacher(Request $request, $class_id)
    {
        $format = [
            'teacher_id' => 'required|integer'
        ];

        try {
            $this->checkFormat($request, $format);

            $this->classService->modifyClassTeacher($class_id, $request['teacher_id']);

            return $this->responseSuccess();
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                $message = $e->getTrace()[0]['args'][0];
            } else {
                $message = $e->getMessage();
            }
            $info = [
                'status' => 'E02',
                'message' => $message
            ];

            return response()->json($info);
        }
    }

    public function getClassInfo($class_id)
    {
        try {
            $data = $this->classService->getClassInfo($class_id);

            return $this->responseSuccess($data);
        } catch (\Exception $e) {
            $info = [
                'status' => 'E02',
                'message' => $e->getMessage()
            ];

            return response()->json($info);
        }
    }

    public function delete($class_id)
    {
        try {
            if ($this->classService->checkClass($class_id)) {
                $this->classService->deleteClass($class_id);
            }

            return $this->responseSuccess();
        } catch (\Exception $e) {
            $info = [
                'status' => 'E02',
                'message' => $e->getMessage()
            ];

            return response()->json($info);
        }
    }

    public function createElectives(Request $request)
    {
        $format = [
            'class_id' => 'required|integer',
            'student_id' => 'required|integer'
        ];

        try {
            $this->checkFormat($request, $format);

            if ($this->classService->checkClass($request['class_id'])) {
                $this->classService->createElectives($request->all());
            }

            return $this->responseSuccess();
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                $message = $e->getTrace()[0]['args'][0];
            } else {
                $message = $e->getMessage();
            }
            $info = [
                'status' => 'E02',
                'message' => $message
            ];

            return response()->json($info);
        }
    }

    public function deleteElectives(Request $request, $class_id)
    {
        $format = [
            'student_id' => 'required|integer'
        ];

        try {
            $this->checkFormat($request, $format);

            if ($this->classService->checkClass($class_id)) {
                $this->classService->deleteElectives($class_id, $request['student_id']);
            }

            return $this->responseSuccess();
        } catch (\Exception $e) {
            $info = [
                'status' => 'E02',
                'message' => $e->getMessage()
            ];

            return response()->json($info);
        }
    }

    public function getClassMember($class_id)
    {
        try {
            $data = $this->classService->getClassMember($class_id);

            return $this->responseSuccess($data);
        } catch (\Exception $e) {
            $info = [
                'status' => 'E02',
                'message' => $e->getMessage()
            ];

            return response()->json($info);
        }
    }
}
