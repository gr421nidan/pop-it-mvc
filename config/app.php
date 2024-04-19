<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'role' => \Middlewares\RoleMiddleware::class,
        'roleEmployees' => \Middlewares\RoleEmployeesMiddleware::class,
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'json' => \Middlewares\JSONMiddleware::class,
    ],



    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'currentDate'=>\Validators\BirthDateValidator::class,
        'passwordLength' =>\Validators\PasswordLengthValidator::class,
        'latinAndDigits'=>\Validators\LatinAndDigitsValidator::class,
        'cyrillic'=>\Validators\CyrillicValidator::class,
        'patronymic'=>\Validators\PatronymicValidator::class,
        'uniqueDiscipline'=>\Validators\UniqueDisciplineValidator::class
    ],
    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],


];
