<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Services\Manager\ManagerAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ManagerAuthController extends Controller
{
    protected $service;

    public function __construct(ManagerAuthService $service)
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
