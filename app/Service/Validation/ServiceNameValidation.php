<?php

namespace Bwyty\ServiceConfigValidator\Service\Validation;

use Bwyty\ServiceConfigValidator\Service\RepoNameCatcher\RepoNameCatcherInterface;

class ServiceNameValidation implements ValidationInterface
{

    public function __construct(
        private RepoNameCatcherInterface $repoNameCatcher
    ) {

    }

    public function getValidationName(): string
    {
        return 'Service Name Validation';
    }

    public function getValidationDescription(): string
    {
        return 'Validates the service name';
    }

    public function validate(mixed $data)
    {
        $data = (array) $data;

        if(!isset($data['service_name'])) {
            throw new \Exception('Service name is required');
        }

        if(is_string($data['service_name']) === false) {
            throw new \Exception('Service name must be a string');
        }

        if($data['service_name'] !== $this->repoNameCatcher->catchRepoName()) {
            throw new \Exception('Service name does not match the repository name.' . PHP_EOL . 'Service name: ' . $data['service_name'] . PHP_EOL . 'Repository name: ' . $this->repoNameCatcher->catchRepoName());
        }
    }
}