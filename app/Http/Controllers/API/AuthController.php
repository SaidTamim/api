<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function Register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' =>'required|max:191',
            'email' =>'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator ->fails()) {
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else
        {

            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);

            $Token = $user->createToken($user->email.'_Token')->plainTextToken;
            return response()->json([
                'status'=>200,
                'username'=>$users->name,
                'token' =>$Token,
                'message' =>'Register Successfully',
            ]);

        }

    }
}
