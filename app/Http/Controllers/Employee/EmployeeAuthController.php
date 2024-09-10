<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Services\Employee\EmployeeAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EmployeeAuthController extends Controller
{
    protected $service;

    public function __construct(EmployeeAuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "identifier" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()){
            return Response::errorResponse($validator->errors());
        }
        return $this->service->login($request);
    }
}
