<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{
    protected string $message = 'Field :field must contain only Cyrillic letters';

    public function rule(): bool
    {
        // Проверяем, содержит ли значение только кириллические символы
        return preg_match('/^\p{Cyrillic}+$/u', $this->value);
    }
}