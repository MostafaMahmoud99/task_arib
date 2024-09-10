<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Services\Manager\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function helpData(Request $request){
        return $this->service->helpData($request);
    }

    public function index(){
        return $this->service->index();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "user_id" => "required|exists:users,id",
            "title" => "required",
            "description" => "required"
        ]);

        if ($validator->fails()){
            return Response::errorResponse($validator->errors());
        }

        return $this->service->store($request);
    }
}
