<?php


namespace App\Services\Manager;


use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TaskService
{
    public function helpData($request){
        $Employees = User::select("id","manager_id","first_name","last_name")->where("manager_id",Auth::id())
        ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$request->search}%"])->get();

        $data = [
            "employees" => $Employees
        ];

        return Response::successResponse($data,"data has been fetched success");
    }

    public function index(){
        $Tasks = Task::where("manager_id",Auth::id())->get();
        return Response::successResponse($Tasks,"tasks have been fetched success");
    }

    public function store($request){
        $userCheck = User::where("manager_id",Auth::id())->find($request->user_id);
        if (!$userCheck){
            return Response::errorResponse("you can't assign this task to this user");
        }
        $Inputs = $request->all();
        $Inputs["manager_id"] = Auth::id();
        $Task = Task::create($Inputs);
        return Response::successResponse($Task,"task has been created success");
    }
}
