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

            $userToken=JWTAuth::fromUser($user);

            DB::commit();
                    
            return $this->tokenUser($userToken, 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error(400);
        }
    }

    public function getBalance() {
        try {
            $data = Auth::user()->balance;
                    
            return $this->userBalance($data, 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error(400);
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
                    
            return $this->topUp(204);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error(400);
        }
    }

    public function guard()
    {
        return User::guard();
    }
}