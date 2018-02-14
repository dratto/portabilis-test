<?php

namespace App\Validators;

use Illuminate\Validation\Validator;

class ExtraValidator extends Validator
{
    const CPF_EXAMPLE   = '999.999.999-99';

    public function validateCPF($attribute, $value, $parameters = [])
    {
        $isValid = $this->validateRegex($attribute, $value, [regex_cpf()]);

        if (!$isValid) {
            return false;
        }

        return isValidCPF($value);
    }
}