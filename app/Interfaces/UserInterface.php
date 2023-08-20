<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterface
{
    public function register(UserRequest $request);

    /*public function login(LoginRequest $request);

    public function logout();

    public function refresh();*/

    public function guard();
}