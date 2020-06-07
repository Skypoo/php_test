<?php

namespace App\Http\Controllers;

use App\Service\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function create(Request $request)
    {
        $format = [
            'name' => 'required|string',
            'email' => 'required|email|unique:student,email'
        ];
        try {
            $this->checkFormat($request, $format);

            $this->studentService->createStudent($request->all());

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

    public function delete($student_id)
    {
        try {
            if ($this->studentService->checkStudent($student_id)) {
                $this->studentService->deleteStudent($student_id);
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
