<?php
class LogifyAlert{
	const serviceUrl = 'configUrl';
	const apiKey = 'configApiKey';
    const userId = 'configUserId';

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