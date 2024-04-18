<?php

use Model\Group;
use Model\Student;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EmployeesTest extends TestCase
{
    #[DataProvider('additionProvider')]

    public function testAddStudents(string $httpMethod, array $userData, string $message): void
    {
        $request = $this->createMock(\Src\Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Employees())->addStudents($request);

        if (!empty($result)) {
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)Student::where('last_name', $userData['last_name'])->count());
        Student::where('last_name', $userData['last_name'])->delete();
    }

    public static function additionProvider(): array
    {
        return [
            ['GET', ['last_name'=>'','name' => '', 'patronymic' => '','date'=>'', 'gender' => '','address'=>'', 'group_id'=>''],'<h3></h3>'],
            ['POST', ['last_name'=>'','name' => '', 'patronymic' => '','date'=>'', 'gender' => '','address'=>'', 'group_id'=>''],'<h3>{"last_name":["Поле last_name должно содержать только кириллические буквы","Поле last_name пусто"],"name":["Поле name должно содержать только кириллические буквы","Поле name пусто"],"date":["Поле date пусто","Поле date некорректно"],"gender":["Поле gender пусто"],"address":["Поле address должно содержать только кириллические буквы","Поле address пусто"],"group_id":["Поле group_id пусто"]}</h3>'],
            ['POST', ['last_name'=>'nikushkina','name' => 'dasha', 'patronymic' => 'андреевна','date'=>'2004-03-01', 'gender' => 'Мужской','address'=>'address', 'group_id'=>'2'],'<h3>{"last_name":["Поле last_name должно содержать только кириллические буквы"],"name":["Поле name должно содержать только кириллические буквы"],"address":["Поле address должно содержать только кириллические буквы"]}</h3>'],
            ['POST', ['last_name'=>'никушкина','name' => 'дарья', 'patronymic' => 'андреевна','date'=>'2024-03-01', 'gender' => 'Женский','address'=>'адрес', 'group_id'=>'2'],'<h3>{"date":["Поле date некорректно"]}</h3>'],
            ['POST', ['last_name'=>'никушкина','name' => 'дарья', 'patronymic' => 'andreevna','date'=>'2000-03-01', 'gender' => 'Женский','address'=>'адрес', 'group_id'=>'2'],'<h3>{"patronymic":["Поле patronymic должно быть путым, либо сдержать кириллические буквы"]}</h3>'],
            ['POST', ['last_name'=>'Иванов','name' => 'Иван', 'patronymic' => 'Иванович','date'=>'2000-01-01', 'gender' => 'Мужской','address'=>'Москва', 'group_id'=>'2'],'<h3></h3>'],
        ];
    }

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '/xampp/htdocs';

//        error_reporting(E_ALL);

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }
}