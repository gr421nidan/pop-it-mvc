<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;

class Employees
{
    public function addStudents(Request $request): string
    {
        return new View('employees.add_students');
    }

    public function addGroup(Request $request): string
    {
        return new View('employees.add_group');
    }
}