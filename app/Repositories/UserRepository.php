<?php

namespace App\Repositories;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use DB;
use JWTAuth;
use Auth;

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

            $token=JWTAuth::fromUser($user);

            DB::commit();
            
            return response()->json([ 'token' => $token ], 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error("Bad Request", 400);
        }
    }

    public function getBalance() {
        try {
            $data = Auth::user()->balance;

            return response()->json([ 'balance' => $data ], 200);      
        } catch(\Exception $e) {
            return $this->error("Unauthorized user", 401);
        }
    }
    
    public function topUpBalance(Request $request)
    {
        DB::beginTransaction();
        try {
            $username = Auth::user()->username;
            $balance = Auth::user()->balance;

            $user=User::where('username','=',$username)->first();
            $user->balance = $balance + $request->amount;
            $user->save();

            DB::commit();
                    
            return response()->json("Topup successful", 204);
        } catch(\Exception $e) {
            return $this->error("Invalid topup amount", 400);
        }
    }

    public function guard()
    {
        return User::guard();
    }
}