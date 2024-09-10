<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Services\Employee\TaskService;
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

    public function index(){
        return $this->service->index();
    }

    public function changeStatus(Request $request,$id){
        $validator = Validator::make($request->all(),[
            "status" => "required|in:pending,in_progress,completed"
        ]);

        if ($validator->fails()){
            return Response::errorResponse($validator->errors());
        }

        return $this->service->changeStatus($request,$id);
    }
}
