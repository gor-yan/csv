<?php

namespace App\Core;

use App\Exceptions\ValidationException;

class Validator
{
    private array $rules = [];
    private array $errors = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate(array $data): bool
    {
        foreach ($this->rules as $field => $rule) {
            if (!isset($data[$field]) || !$rule($data[$field])) {
                $this->errors[$field] = "Invalid value for $field";
            }
        }

        if (!empty($this->errors)) {
            throw new ValidationException($this->errors);
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
