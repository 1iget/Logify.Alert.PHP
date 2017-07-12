<?php
class LogifyAlert{
    public $settings = array(
        //'serviceUrl' => 'http://logify.devexpress.devx:59240/api/report/newreport',
        'apiKey' => '2F7B18D129F940E0A512956BF4AB9561',
        'userId' => 'php user',
        'appName' => 'Test PHP Application',
        'appVersion' => '2.1.1.1',
        );

    public $globalVariablesPermissions = array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'environment' => true,
        'request' => true,
        'server' => true,
        );
}
?>