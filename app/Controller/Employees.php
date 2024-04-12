<?php

namespace Controller;

use Model\Discipline;
use Model\Group;
use Model\Student;
use Src\View;
use Src\Request;
use Model\User;

class Employees
{
    public function addStudents(Request $request): string
    {
        $select_groups = Group::all();
        if ($request->method === 'POST') {
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
        if ($request->method === 'POST' && Group::create($request->all())) {
            app()->route->redirect('/groups');
        }
        return new View('employees.add_group');
    }

    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST' && Discipline::create($request->all())) {
            app()->route->redirect('/disciplines');
        }
        return new View('employees.add_discipline');
    }

    public function cabinet(Request $request): string
    {
        return new View('employees.cabinet');
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
        return new View('employees.group');
    }

    public function studentGrade(Request $request): string
    {
        return new View('employees.gradeStudent');
    }

    public function evaluations(Request $request): string
    {
        return new View('employees.evaluations');
    }
}