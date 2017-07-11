<?php
class LogifyAlert{
    public $settings = array(
        'serviceUrl' => 'configUrl',
        'apiKey' => 'configApiKey',
        'userId' => 'configUserId',
        'appName' => 'tests',
        'appVersion' => 't.0',
    );

    public $globalVariablesPermissions = array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        );
}