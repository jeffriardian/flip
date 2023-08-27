<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use App\Http\Requests\DataRequest;

interface UserInterface
{
    public function register(UserRequest $request);

    public function getBalance();

    public function topUpBalance(DataRequest $request);
    
    public function transfer(DataRequest $request);
    
    public function topUser();
    
    public function topTransactionUser();

    public function guard();
}