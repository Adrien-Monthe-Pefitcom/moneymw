<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;
use Response;


class AuthController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }*/

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try{
            if(! $token = JWTAuth::attempt($credentials))
            {
                return response()->json([
                    'error' => 'User credentials are not correct!'], 401);
            }
        }catch(JWTException $ex){
            return response()->json([
                'error' => 'Something went wrong!'], 500);
        }
        return response()->json(compact('token'))->setStatusCode(200);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function logout(Request $request) {
        $token = $request -> header('auth-token');

        if($token) {
                JWTAuth::setToken($token)->invalidate();
                return response()->json([
                    'success' => 'LogOut Successfully!'], 200);
        } else {
            return response()->json([
                'error' => 'Something went wrong!'], 500);
        }
    }
}
