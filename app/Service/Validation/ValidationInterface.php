<?php

namespace Bwyty\ServiceConfigValidator\Service\Validation;

interface ValidationInterface {

    public function getValidationName(): string;

    public function getValidationDescription(): string;

    public function validate(array $data);

}
