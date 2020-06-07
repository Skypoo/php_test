<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkFormat(Request $request, $data)
    {
        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            THROW ValidationException::withMessages($validator->errors()->all());
        }
    }

    public function responseSuccess($data = null)
    {
        $result = [
            'status'    => 'Success',
            'data'   => $data
        ];

        return response()->json($result);
    }

}
