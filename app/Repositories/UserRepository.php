<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use DB;
use JWTAuth;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;
    
    public function register(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User;
            $user->username = $request->username;
            $user->save();

            $user=User::where('username','=',$request->username)->first();

            $userToken=JWTAuth::fromUser($user);

            DB::commit();
                    
            return $this->success("User created", $userToken, 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error("Bad Request", 400);
        }
    }

    /*public function login(LoginRequest $request)
    {
        $credentials = $request->only('username');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success', 'token' => $token, 'message' => 'Logged in Successfully.'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }*/

    public function guard()
    {
        return User::guard();
    }
}