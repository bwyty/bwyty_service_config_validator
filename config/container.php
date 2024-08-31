<?php

use Bwyty\ServiceConfigValidator\Service\ConfigDataCatcher\ConfigDataCatcher;
use Bwyty\ServiceConfigValidator\Service\ConfigDataCatcher\ConfigDataCatcherInterface;
use Bwyty\ServiceConfigValidator\Service\RepoNameCatcher\RepoNameCatcher;
use Bwyty\ServiceConfigValidator\Service\RepoNameCatcher\RepoNameCatcherInterface;
use Bwyty\ServiceConfigValidator\Service\Validation\QueueConfigValidation;
use Bwyty\ServiceConfigValidator\Service\Validation\ServiceNameValidation;
use Bwyty\ServiceConfigValidator\ValidationStack;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

$containerBuilder = new ContainerBuilder();

$container = $containerBuilder->build();

$container->set(RepoNameCatcherInterface::class, DI\autowire(RepoNameCatcher::class));

$container->set(ConfigDataCatcherInterface::class, DI\autowire(ConfigDataCatcher::class));

$container->set(ValidationStack::class, function (ContainerInterface $container) {
    $validationStack = new ValidationStack();
    $validationStack->addValidation($container->get(ServiceNameValidation::class));
    $validationStack->addValidation($container->get(QueueConfigValidation::class));
    return $validationStack;
});

return $container;