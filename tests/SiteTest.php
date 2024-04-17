<?php

use Model\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
class SiteTest extends TestCase
{
    #[DataProvider('additionProvider')]


    public function testLogin(string $httpMethod, array $userData, string $message): void
    {
        // Проверяем, если пользователь с логином 'proverka1' передан в тест

        if ($userData['login'] === 'proverka1') {
            // Создаем пользователя с незахешированным паролем 'proverka1'
            User::create([
                'login' => $userData['login'],
                'password' => md5('proverka1')
            ]);
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->login($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем есть ли такой пользователь в базе данных
        $userExists = User::where('login', $userData['login'])->exists();
        $this->assertTrue($userExists);

        //Проверяем редирект при успешной регистрации
        $this->assertContains($message, xdebug_get_headers());
        //Удаляем созданного пользователя из базы данных
        User::where('login', $userData['login'])->delete();
    }


    //Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['GET', ['login' => '', 'password' => ''], '<h3></h3>'],
            ['POST', ['login' => md5(time()), 'password' => md5(time())], '<h3>Неправильные логин или пароль</h3>'],
            ['POST', ['login' => 'dasha', 'password' => md5(time())], '<h3>Неправильные логин или пароль</h3>'],
            ['POST', ['login' => md5(time()), 'password' => 'admin123'], '<h3>Неправильные логин или пароль</h3>'],
            ['POST', ['login' => '', 'password' => ''], '<h3>Неправильные логин или пароль</h3>'],
            ['POST', ['login' => 'proverka1', 'password' => 'proverka1'], 'Location: /pop-it-mvc/hello'],
        ];
    }

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '/xampp/htdocs';

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