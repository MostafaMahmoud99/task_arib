<?php


namespace App\Services\Employee;


use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TaskService
{
    public function index(){
        $user = Auth::user();
        $Tasks = $user->Tasks;
        return Response::successResponse($Tasks,"task has been fetched success");
    }

    public function changeStatus($request,$id){
        $Task = Task::where("user_id",Auth::id())->find($id);
        if (!$Task){
            return Response::errorResponse("not found task");
        }

        $Task->update([
            "status" => $request->status
        ]);

        return Response::successResponse([],"status has been changed success");
    }
}
