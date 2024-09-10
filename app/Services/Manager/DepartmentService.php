<?php


namespace App\Services\Manager;


use App\Models\Department;
use Illuminate\Support\Facades\Response;

class DepartmentService
{
    public function index($request){
        $Departments = Department::withCount("Users")->withSum("Users","salary")
            ->where("title","like","%".$request->search."%")->get();

        return Response::successResponse($Departments,"data has been fetched success");
    }

    public function store($request){
        $Department = Department::create($request->all());
        return Response::successResponse($Department,"department has been created success");
    }

    public function update($request,$id){
        $Department = Department::find($id);
        if (!$Department){
            return Response::errorResponse("not found department");
        }

        $Department->update($request->all());
        return Response::successResponse([],"department has been updated success");
    }

    public function destroy($id){
        $Department = Department::whereDoesntHave("Users")->find($id);
        if (!$Department){
            return Response::errorResponse("not found department");
        }

        $Department->delete();
        return Response::successResponse([],"department has been deleted success");
    }
}
