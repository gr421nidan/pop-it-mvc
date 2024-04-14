<?php

namespace Controller;

use Model\Control;
use Model\Discipline;
use Model\DisciplinesGroup;
use Model\Grade;
use Model\Group;
use Model\Image;
use Model\Student;
use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;


class Employees
{
    public function addStudents(Request $request): string
    {
        $select_groups = Group::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'last_name' => ['required:students,last_name'],
                'name'=>['required:students,first_name'],
                'date' => ['required','currentDate'],
                'gender' => ['required'],
                'address' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'currentDate'=>'Поле :field некорректно'
            ]);
            if ($validator->fails()) {
                return new View('employees.add_students',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            $data = $request->all();
            $group = Group::find($data['group_id']);
            if ($group) {
                Student::create([
                    'last_name' => $data['last_name'],
                    'first_name' => $data['name'],
                    'patronymic' => $data['patronymic'],
                    'gender' => $data['gender'],
                    'date' => $data['date'],
                    'address' => $data['address'],
                    'id_group' => $group->id
                ]);
                app()->route->redirect('/students');
            }
        }

        return new View('employees.add_students', ['select_groups' => $select_groups]);
    }

    public function addGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:groups_students,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if ($validator->fails()) {
                return new View('employees.add_group',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Group::create($request->all())) {
                app()->route->redirect('/groups');
            }
        }
        return new View('employees.add_group');
    }

    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:disciplines,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if ($validator->fails()) {
                return new View('employees.add_discipline',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Discipline::create($request->all())) {
                app()->route->redirect('/disciplines');
            }
        }
        return new View('employees.add_discipline');
    }

    public function cabinet(Request $request): string
    {
        $image=Image::all();
        return new View('employees.cabinet',['image'=>$image]);
    }
    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }
    public function groups(Request $request): string
    {
        $groups=Group::all();
        return new View('employees.groups', ['groups'=>$groups]);
    }

    public function disciplines(Request $request): string
    {
        $disciplines=Discipline::all();
        return new View('employees.disciplines',['disciplines'=>$disciplines]);
    }
    public function gradeStudents(Request $request): string
    {

        return new View('employees.gradeStudents');
    }

    public function group(Request $request): string
    {
        $groupId = $request->id;
        $discipline_name=Discipline::all();
        $control_name=Control::all();
        $group = DisciplinesGroup::where('id_group', $request->id)->get();
        if ($request->method === 'POST') {
            $data = $request->all();
            $group = Group::find($data['group_id']);
            $id_discipline = Discipline::where('name', $data['discipline_names'])->first();
            $id_control = Control::where('name', $data['control_names'])->first();
            if ($group && $id_control && $id_discipline) {
                DisciplinesGroup::create([
                    'id_group' => $group->id,
                    'id_disciplines' => $id_discipline->id,
                    'id_control' => $id_control->id,
                    'number_hours' => $data['num_hours'],
                    'course' => $data['course'],
                    'semester' => $data['semester']
                ]);
                app()->route->redirect('/groups');
            }
        }
        $groupName = Group::find($groupId)->name;
        return new View('employees.group', ['group' => $group, 'discipline_name'=>$discipline_name,'control_name'=>$control_name, 'groupName' => $groupName, 'groupId' => $groupId, ]);

    }

    public function studentGrade(Request $request):string
    {
        $controls = Control::all();
        $studentGrade = Grade::where('id_student', $request->id)->with('student', 'evaluations', 'disciplinesGroup')->get();
        return new View('employees.gradeStudent', ['studentGrade' => $studentGrade, 'controls' => $controls]);
    }

    public function evaluations(Request $request): string
    {
        return new View('employees.evaluations');
    }


}