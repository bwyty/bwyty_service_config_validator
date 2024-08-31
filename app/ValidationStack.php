<?php

namespace Bwyty\ServiceConfigValidator;

use Bwyty\ServiceConfigValidator\Service\Validation\ValidationInterface;

class ValidationStack {

    private array $validations = [];

    public function addValidation(ValidationInterface $validation): void {
        $this->validations[] = $validation;
    }

    public function validate(mixed $data): \Generator {
        foreach($this->validations as $validation) {
            yield 'start' => $validation->getValidationName();

            yield 'description' => $validation->getValidationDescription();

            $validation->validate($data);

            yield 'end' => $validation->getValidationName();
        }
    }
}