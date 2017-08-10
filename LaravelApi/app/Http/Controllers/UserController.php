<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function SignUp(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email')
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user !'
        ], 201);
    }

    public function SignIn(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        try{
            //Create token
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 400);
            }
        }
        catch(JWTException $excepton){
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
        return response()->json([
            'token' => $token
        ], 200);
    }
}
