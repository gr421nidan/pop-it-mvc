<?php

namespace Controller;

use Model\Student;
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
}
