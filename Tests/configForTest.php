<?php
class LogifyAlert {

    public $settings = array(
        'serviceUrl' => 'configUrl',
        'apiKey' => 'configApiKey',
        'userId' => 'configUserId',
        'appName' => 'testsConfig',
        'appVersion' => 't.c.0',
    );
    public $collectExtensions = true;
    public $offlineReportsEnabled = true;
    public $offlineReportsCount = 20;
    public $offlineReportsDirectory = 'configDir';
    public $breadcrumbsMaxCount = 100;
    public $ignoreGetBody = false;
    public $ignorePostBody = false;
    public $ignoreCookies = false;
    public $ignoreFilesBody = false;
    public $ignoreEnvironmentBody = false;
    public $ignoreRequestBody = false;
    public $ignoreServerVariables = false;

}