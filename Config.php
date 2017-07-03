<?php
class LogifyAlert{
	const serviceUrl = 'http://logify.devexpress.com/api/report/newreport';
	const apiKey = '2F7B18D129F940E0A512956BF4AB9561';
    const userId = 'php test user';
    const appName = 'Test PHP Application';
    const appVersion = '1.0.0.0';

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