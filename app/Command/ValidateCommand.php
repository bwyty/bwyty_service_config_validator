<?php

namespace Bwyty\ServiceConfigValidator\Command;

use Bwyty\ServiceConfigValidator\Service\ConfigDataCatcher\ConfigDataCatcherInterface;
use Bwyty\ServiceConfigValidator\ValidationStack;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand
{

    public function __construct(
        private ValidationStack $validationStack,
        private ConfigDataCatcherInterface $configDataCatcher
    ){
    }

    public function __invoke(OutputInterface $output)
    {
        $output->writeln('-> Validating app.json');

        $appData = $this->configDataCatcher->catchConfigData();

        $this->validationStack->validate($appData);
    }
}
