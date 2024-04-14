<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class LatinAndDigitsValidator extends AbstractValidator
{
    protected string $message = 'Field :field must contain only latin letters and digits';

    public function rule(): bool
    {
        // Проверяем, содержит ли значение только латинские буквы и цифры
        return preg_match('/^[a-zA-Z0-9]+$/', $this->value);
    }
}