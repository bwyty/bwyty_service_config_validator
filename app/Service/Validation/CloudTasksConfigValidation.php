<?php

namespace Bwyty\ServiceConfigValidator\Service\Validation;

use Swaggest\JsonSchema\Schema;

class CloudTasksConfigValidation implements ValidationInterface
{

    private $schema;

    public function __construct() {
        $schemaJson = file_get_contents(__DIR__ . '/cloud_tasks_json_schema.json');

        $this->schema = Schema::import(json_decode($schemaJson));
    }

    public function getValidationName(): string
    {
        return 'Queue Config Validation';
    }

    public function getValidationDescription(): string
    {
        return 'Validates the queue configuration';
    }

    public function validate(mixed $data)
    {
        if(!isset($data->cloud_tasks)) {
            return;
        }

        $this->schema->in($data->cloud_tasks);
    }
}
