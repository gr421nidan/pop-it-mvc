<?php

namespace Controller;

use Model\Student;
use Src\Auth\Auth;
use Src\Request;
use Src\View;

class Api
{
    public function index(): void
    {
        $students = Student::all()->toArray();

        (new View())->toJSON($students);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }
    public function login(Request $request): void
    {
        $data = $request->all();

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = bin2hex(random_bytes(25));
            $user->token = hash('md5', $token);
            $user->save();

            (new View())->toJSON(['token' => $token], 200);
        }

        (new View())->toJSON(['message' => 'Неавторизован'], 401);
    }
    public function logout(Request $request){
        $data = $request->all();
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $user->token='';
            $user->save();

            (new View())->toJSON(['message' => 'Вы вышли!'], 200);
        }
    }
}
