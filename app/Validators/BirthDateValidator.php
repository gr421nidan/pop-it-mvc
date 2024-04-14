<?php

namespace Validators;

use DateTime;
use Src\Validator\AbstractValidator;

class BirthDateValidator extends AbstractValidator
{
    protected string $message = 'Field : must be correct';
    public function rule(): bool
    {
        $currentDate = new DateTime();
        $date = DateTime::createFromFormat('Y-m-d', $this->value);
        if (!$date) {
            return false;
        }
        $sixteenYearsAgo = $currentDate->modify('-16 years');
        if ($date > $sixteenYearsAgo) {
            return false;
        }
        $fortyYearsAgo = $currentDate->modify('-40 years');
        if ($date < $fortyYearsAgo) {
            return false;
        }
        return true;
    }
}