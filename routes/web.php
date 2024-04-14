<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/addEmployees', [Controller\Admin::class, 'addEmployees'])->middleware('auth', 'role');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'],'/addStudents', [Controller\Employees::class, 'addStudents'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/addGroup', [Controller\Employees::class, 'addGroup'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/addDiscipline', [Controller\Employees::class, 'addDiscipline'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/cabinet', [Controller\Employees::class, 'cabinet'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/students', [Controller\Employees::class, 'students'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/groups', [Controller\Employees::class, 'groups'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/disciplines', [Controller\Employees::class, 'disciplines'])->middleware('auth', 'roleEmployees');
Route::add('GET','/gradeStudents', [Controller\Employees::class, 'gradeStudents'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/groups/group', [Controller\Employees::class, 'group'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/student/grade', [Controller\Employees::class, 'studentGrade'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/groups/group/evaluations', [Controller\Employees::class, 'evaluations'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/groups/group/addDiscipline', [Controller\Employees::class, 'addDisciplineInGroup'])->middleware('auth', 'roleEmployees');

