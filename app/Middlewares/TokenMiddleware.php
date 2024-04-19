<?php

namespace Middlewares;


use Src\Auth\Auth;
use Src\Request;
use Src\View;


class TokenMiddleware
{
    public function handle(Request $request)
    {
        if (!Auth::tokenCheck()) {
            (new View())->toJSON(['message' => 'Вы не авторизованы!'], 401);
        }
    }
}