<?php

namespace Controller;

use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;


class Admin
{
    public function addEmployees(Request $request): string
    {
        if ($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login', 'latinAndDigits::users,login'],
                'password' => ['required', 'passwordLength','latinAndDigits::users,password'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'passwordLength'=>'Пароль должен быть минимум 6 символов',
                'latinAndDigits'=>'Поле :field использует кириллицу',

            ]);
            if($validator->fails()){
                return new View('admin.add_employees',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if(User::create($request->all())) {
                app()->route->redirect('/hello');
                return false;
            }
        }
        return new View('admin.add_employees');
    }
}