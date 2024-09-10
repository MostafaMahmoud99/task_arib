<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Services\Manager\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    protected $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        return $this->service->index($request);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "description" => "nullable"
        ]);

        if ($validator->fails()){
            return Response::errorResponse($validator->errors());
        }

        return $this->service->store($request);
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "description" => "nullable"
        ]);

        if ($validator->fails()){
            return Response::errorResponse($validator->errors());
        }

        return $this->service->update($request,$id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
