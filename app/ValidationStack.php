<?php

namespace Bwyty\ServiceConfigValidator;

use Bwyty\ServiceConfigValidator\Service\Validation\ValidationInterface;

class ValidationStack {

    private array $validations = [];

    public function addValidation(ValidationInterface $validation): void {
        $this->validations[] = $validation;
    }

    public function validate(array $data): void {
        foreach($this->validations as $validation) {
            $validation->validate($data);
        }
    }
}