<?php

namespace App\Http\Controllers;

use App\Service\TeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    private $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function create(Request $request)
    {
        $format = [
            'name' => 'required|string',
            'email' => 'required|email|unique:teacher,email'
        ];

        try {
            $this->checkFormat($request, $format);

            $this->teacherService->createTeacher($request->all());

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

    public function delete($teacher_id)
    {
        try {
            if ($this->teacherService->checkTeacher($teacher_id)) {
                $this->teacherService->deleteTeacher($teacher_id);
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
}
