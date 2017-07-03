<?php
class LogifyAlert{
	const serviceUrl = 'http://logify.devexpress.com/api/report/newreport';
	const apiKey = '2F7B18D129F940E0A512956BF4AB9561';

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