<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserInterface
{
    public function register(UserRequest $request);

    public function getBalance();

    public function topUpBalance(Request $request);

    public function guard();
}