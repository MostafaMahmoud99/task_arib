<?php


namespace App\Services\Employee;


use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class EmployeeAuthService
{
    public function login($request){
        $user = $this->checkLogin($request->identifier,$request->password);
        if($user){
            auth('api')->setUser($user);

            $token = Auth::guard('api')->user()->createToken('passport_token',["employee"])->accessToken;
            $user = Auth::guard('api')->user();
            $success['user'] =  $user;
            $success['token'] =  $token;

            return Response::successResponse($success,"User login successfully.");
        }
        else{
            return Response::errorResponse("Unauthorised.");
        }
    }

    private function checkLogin($identifier,$password){
        $user = User::where('email',$identifier)->orWhere("phone",$identifier)->first();
        if($user&&Hash::check($password, $user->password)){
            return $user;
        }else{
            return null;
        }
    }
}
