<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PasswordLengthValidator extends AbstractValidator
{
    protected string $message = 'Пароль должен содержать минимум 6 символов';

    public function rule(): bool
    {
        $password = $this->value;
        return strlen($password) >= 6;
    }
}