<?php

require 'vendor/autoload.php';

use Bwyty\ServiceConfigValidator\Command\ValidateCommand;

$app = new Silly\Application();

$container = require 'container.php';

$app->useContainer($container);

$app->command('validate', ValidateCommand::class)->descriptions('Validate a service configuration');

$app->run();