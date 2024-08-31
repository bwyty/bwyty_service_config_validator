<?php

namespace Bwyty\ServiceConfigValidator\Service\Validation;

use Swaggest\JsonSchema\Schema;

class QueueConfigValidation implements ValidationInterface
{

    private $schema;

    public function __construct() {
        $schemaJson = file_get_contents(__DIR__ . '/queue_json_schema.json');

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

    public function validate(array $data)
    {
        if(!isset($data['queue'])) {
            throw new \Exception('Queue configuration is required');
        }

        $this->schema->in($data['queue']);
    }
}
