<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create (Request $req){
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:9'
        ];
        $validator = \Validator::make($req->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'status' => $validator->errors() ->all()
            ],400);
        }
        $user = User::create([
            'name'=>$req->name,'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'creado correctamente',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);



    }

    public function login(Request $req){
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:9'
        ];

        $validator = \Validator::make($req->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->errors() ->all()
            ],400);
        }

        if(!Auth::attempt($req->only('email','password'))){
            return response()->json([
                'status' => false,
                'error' => ['Unauthorized']
            ],401);
        }
        $user = User::where('email',$req->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'creado correctamente',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }


    public function loguot(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ]);
    }
}
