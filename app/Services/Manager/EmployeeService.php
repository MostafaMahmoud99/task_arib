<?php


namespace App\Services\Manager;


use App\Http\Resources\Manager\EmployeeIndexResource;
use App\Models\Media;
use App\Models\User;
use App\Traits\GeneralFileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class EmployeeService
{
    use GeneralFileService;

    public function index($request){
        $Employees = User::with(["media","Manager" => function($q){
            $q->select("id","first_name","last_name");
        }])->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$request->search}%"])
            ->orWhere("email","like","%".$request->search."%")->get();

        return Response::successResponse(EmployeeIndexResource::collection($Employees),"data has been fetched success");
    }

    public function store($request){
        $Inputs = $request->all();
        $Inputs["manager_id"] = Auth::id();
        $Inputs["password"] = Hash::make($request->password);
        $employee = User::create($Inputs);

        if ($request->media && $request->media != null){
            $path = "ProfilePicture/";
            $file_name = $this->SaveFile($request->media,$path);
            $type = $this->getFileType($request->media);

            Media::create([
                'mediable_type' => $employee->getMorphClass(),
                'mediable_id' => $employee->id,
                'title' => "Profile Picture",
                'type' => $type,
                'directory' => $path,
                'filename' => $file_name
            ]);
        }

        return Response::successResponse($employee,"employee has been created success");
    }

    public function update($request,$id){
        $employee = User::find($id);
        if (!$employee){
            return Response::errorResponse("not found employee");
        }

        $employee->update($request->all());

        if ($request->media && $request->media != null){
            $employeeMedia = $employee->media;
            if ($employeeMedia){
                $this->removeFile($employeeMedia->file_path);
            }

            $path = "ProfilePicture/";
            $file_name = $this->SaveFile($request->media,$path);
            $type = $this->getFileType($request->media);

            $employeeMedia->update([
                'type' => $type,
                'directory' => $path,
                'filename' => $file_name
            ]);
        }

        return Response::successResponse([],"employee has been updated success");
    }

    public function destroy($id){
        $employee = User::find($id);
        if (!$employee){
            return Response::errorResponse("not found employee");
        }

        $media = $employee->media;

        if ($media){
            $this->removeFile($media->file_path);
            $media->delete();
        }

        $employee->delete();
        return Response::successResponse([],"employee has been deleted success");
    }

}
