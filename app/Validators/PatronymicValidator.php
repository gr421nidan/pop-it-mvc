<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PatronymicValidator extends AbstractValidator
{
    protected string $message = 'Field :field is contains the Latin alphabet';

    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true; // Разрешаем пустое значение
        }

        return preg_match('/^\p{Cyrillic}*$/u', $this->value);
    }

}