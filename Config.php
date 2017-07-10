<?php
class LogifyAlert{
	const serviceUrl = 'http://logify.devexpress.com/api/report/newreport';
    //const serviceUrl = 'http://logify.devexpress.devx:59240/api/report/newreport';
	const apiKey = '2F7B18D129F940E0A512956BF4AB9561';
    const userId = 'php user';
    const appName = 'Test PHP Application';
    const appVersion = '2.1.1.1';

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
?>