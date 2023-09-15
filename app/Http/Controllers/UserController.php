<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserRequest $request){
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $user = User::where("uemail",$email)
                    ->where("upassword",md5($password))
                    ->first();

        if($user){
            return response()->json(["error" => "Este email ja existe"]);
        }

        $user = User::create([
            "uemail" => $email,
            "upassword" => md5($password),
            "uname" => $name    
        ]);

        return response()->json([$user]);
        
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $user = User::where("uemail",$email)
                        ->where("upassword",md5($password))
                        ->first();
        if(!$user){
            return response()->json(["error" => "Dados incorrectos"]);
        }

        return $user;
    }

    public function one($id = 0){
        $user = User::find($id);

        return $user;
    }

    public function update(UserRequest $request, $id = 0){
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $user = User::find($id);

        if(!$user){
            return response()->json(["error" => "Usuario nao existe"]);
        }

        $userData = $user->update([
            "uemail" => $email,
            "upassword" => md5($password),
            "uname" => $name    
        ]);

        return response()->json(["data" => $userData]);
    }
}
