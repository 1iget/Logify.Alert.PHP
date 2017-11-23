<?php
class LogifyAlert {

    public $settings = array(
        //'serviceUrl' => 'http://logify.devexpress.devx:59240/api/report/newreport',
        'apiKey' => '2F7B18D129F940E0A512956BF4AB9561',
        'userId' => 'php test user 1.2',
        'appName' => 'PHP Application 1.2',
        'appVersion' => '1.2.0.0',
    );
    public $collectExtensions = false;
    
    public $breadcrumbsMaxCount = 1000;
    
    public $offlineReportsCount = 10;
    public $offlineReportsDirectory = 'C:/Temp/lartrprt/';
    public $offlineReportsEnabled = true;
    public $ignoreGetBody = true;
    public $ignorePostBody = true;
    public $ignoreCookies = true;
    public $ignoreFilesBody = true;
    public $ignoreEnvironmentBody = true;
    public $ignoreRequestBody = true;
    public $ignoreServerVariables = true;

}
?>