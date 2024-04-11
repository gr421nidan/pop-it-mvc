<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/addEmployees', [Controller\Admin::class, 'addEmployees'])->middleware('auth', 'role');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'],'/addStudents', [Controller\Employees::class, 'addStudents'])->middleware('auth');

//->middleware('auth')