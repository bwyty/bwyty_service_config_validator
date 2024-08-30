<?php

// get the app data

$configFile = getenv('GITHUB_WORKSPACE') . '/app.json';

$rawAppData = file_get_contents($configFile);

$appData = json_decode($rawAppData, true);

if(json_last_error() !== JSON_ERROR_NONE) {
    echo 'Invalid JSON';
    exit(1);
}

unset($rawAppData);

// validate the repository name

$serviceName = $appData['service_name'];

$repoName = getenv('GITHUB_REPOSITORY');

if($repoName !== $appName) {
    echo 'Repository name does not match app name.';
    exit(1);
}

// validate the queue configs

$queueConfigs = $appData['queue'];

if(!is_array($queueConfigs)) {
    echo 'Invalid queue configs.';
    exit(1);
}

if(!isset($queueConfigs['available']) || is_bool($queueConfigs['available'])) {
    echo 'Invalid queue configs. Available key is required and must be a boolean.';
    exit(1);
}

if($queueConfigs['available'] === true) {

    if(!isset($queueConfigs['engine']) || !is_string($queueConfigs['engine'])) {
        echo 'Invalid queue configs. Engine key is required and must be a string.';
        exit(1);
    }

    if(in_array($queueConfigs['engine'], ['cloud_tasks']) === false) {
        echo 'Invalid queue configs. Engine key must be one of the following: cloud_tasks.';
        exit(1);
    }
}