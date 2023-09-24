<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $isStatusValidated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'max:255']
            ]);

            if ($isStatusValidated) {
                $isStatusUserCreated = User::create([
                    'name' =>  $request->name,
                    'email' =>  $request->email,
                    'password' =>  $request->password,
                    'role' => 'user'
                ]);
            } else return response(['status' => false]);

            
            return ($isStatusUserCreated) ? response([
                'status' => true,
                'data' => $isStatusUserCreated
            ]) : response(['status' => false]);
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $isStatusAuth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $token = Str::random(60);
            if ($isStatusAuth) {
                User::where(['email' => $request->email])->update(['remember_token' => $token]);
                return response([
                    'status' => $isStatusAuth,
                    'token' => $token
                ]);
            } else return response(['status' => false]);
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function get(Request $request) {
        try {
            $users = User::where(['remember_token' => $request->token])->get();
            return response((count($users) > 0) ? $users[0] : "not found");
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
