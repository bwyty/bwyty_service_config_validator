<?php

namespace Bwyty\ServiceConfigValidator\Service\ConfigDataCatcher;

use Bwyty\ServiceConfigValidator\Service\ConfigDataCatcher\ConfigDataCatcherInterface;

class ConfigDataCatcher implements ConfigDataCatcherInterface {

    public function catchConfigData(): mixed {
        $configFile = getenv('GITHUB_WORKSPACE') . '/app.json';

        if(!file_exists($configFile)) {
            throw new \Exception('app.json does not exist');
        }

        $rawAppData = file_get_contents($configFile);

        if($rawAppData === false) {
            throw new \Exception('Could not read app.json');
        }

        $appData = json_decode($rawAppData);

        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON format');
        }

        unset($rawAppData);

        return $appData;
    }

}
