<?php


namespace App\Services\Manager;


use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ManagerAuthService
{
    public function login($request){
        $user = $this->checkLogin($request->identifier,$request->password);
        if($user){
            auth('manager')->setUser($user);

            $token = Auth::guard('manager')->user()->createToken('passport_token',["manager"])->accessToken;
            $user = Auth::guard('manager')->user();
            $success['user'] =  $user;
            $success['token'] =  $token;

            return Response::successResponse($success,"User login successfully.");
        }
        else{
            return Response::errorResponse("Unauthorised.");
        }
    }

    private function checkLogin($identifier,$password){
        $user = Manager::where('email',$identifier)->orWhere("phone",$identifier)->first();
        if($user&&Hash::check($password, $user->password)){
            return $user;
        }else{
            return null;
        }
    }
}
