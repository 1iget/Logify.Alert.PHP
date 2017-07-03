<?php
class LogifyAlert{
	const serviceUrl = 'configUrl';
	const apiKey = 'configApiKey';
    const userId = 'configUserId';
    const appName = 'tests';
    const appVersion = 't.0';

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