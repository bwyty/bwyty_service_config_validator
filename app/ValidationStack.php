<?php

namespace Bwyty\ServiceConfigValidator;

use Bwyty\ServiceConfigValidator\Service\Validation\ValidationInterface;

class ValidationStack {

    private array $validations = [];

    public function addValidation(ValidationInterface $validation): void {
        $this->validations[] = $validation;
    }

    public function validate(array $data): \Generator {
        foreach($this->validations as $validation) {
            yield 'start' => $validation->getValidationName();

            $validation->validate($data);

            yield 'end' => $validation->getValidationName();
        }
    }
}