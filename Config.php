<?php
class LogifyAlert{
    public $settings = array(
        //'serviceUrl' => 'http://logify.devexpress.devx:59240/api/report/newreport',
        'apiKey' => '2F7B18D129F940E0A512956BF4AB9561',
        'userId' => 'php test user 1.2',
        'appName' => 'PHP Application 1.2',
        'appVersion' => '1.2.0.0',
        );
    public $collectExtensions = true;
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