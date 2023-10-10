<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role');

        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);

        if($register){
            return response()->json([
                'success' => true,
                'message' => 'Register Succes',
                'data' => $register
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Register Fail',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');


        $user = User::where('email', $email)->first();
        if($user){
            if(Hash::check($password, $user->password)){

                return response()->json([
                    'success' => true,
                    'message' => 'Login Succes',
                    'data' => [
                        'user' => $user,
                    ]
                ], 201);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Login Fail',
                    'data' => ''
                ], 400);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Login Fail',
                'data' => ''
            ], 400);
        }

       
    }
}
