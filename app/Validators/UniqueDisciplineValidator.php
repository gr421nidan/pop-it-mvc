<?php

namespace Validators;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Validator\AbstractValidator;

class UniqueDisciplineValidator extends AbstractValidator
{
    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        $groupId = $this->args[0];
        $disciplineId = $this->value;
        $exists = Capsule::table('disciplines_group')->where('id_group',$groupId)->where('id_disciplines',$disciplineId)->exists();
        return !$exists;
    }
}