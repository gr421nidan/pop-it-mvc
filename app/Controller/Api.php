<?php

namespace Controller;

use Model\Control;
use Model\Discipline;
use Model\DisciplinesGroup;
use Model\Group;
use Model\Student;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
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
    public function addDisciplineInGroup(Request $request): void
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $validator = new Validator($data, [
                'id_disciplines' => ['uniqueDiscipline:'.$data['group_id'],'required'],
                'control_names' => ['required'],
                'course' => ['required'],
                'semester' => ['required'],
                'num_hours' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'uniqueDiscipline' => 'Такая дисциплина уже есть у группы',
            ]);
            if($validator->fails()){
                (new View())->toJSON(['message' => $validator->errors()], 422);
            }
            $disciplinesGroup = DisciplinesGroup::create([
                'id_group' => $data['group_id'],
                'id_disciplines' => $data['id_disciplines'],
                'id_control' => $data['control_names'],
                'number_hours' => $data['num_hours'],
                'course' => $data['course'],
                'semester' => $data['semester']
            ]);
            if($disciplinesGroup){
                (new View())->toJSON(['message' => 'Дисциплина добавлена в группу!'], 200);
            }
        }
        (new View())->toJSON($request->all());
    }

}

