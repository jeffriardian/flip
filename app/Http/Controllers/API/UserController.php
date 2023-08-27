<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\DataRequest;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected $userInteface;

    public function __construct(UserInterface $userInteface)
    {
        $this->userInteface = $userInteface;
    }
    
    public function register(UserRequest $request)
    {
        return $this->userInteface->register($request);
    }
    
    public function getBalance()
    {
        return $this->userInteface->getBalance();
    }
    
    public function topUpBalance(DataRequest $request)
    {
        return $this->userInteface->topUpBalance($request);
    }
    
    public function transfer(DataRequest $request)
    {
        return $this->userInteface->transfer($request);
    }
    
    public function topUser()
    {
        return $this->userInteface->topUser();
    }
    
    public function topTransactionUser()
    {
        return $this->userInteface->topTransactionUser();
    }
}
