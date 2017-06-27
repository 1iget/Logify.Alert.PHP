<?php
    require_once('/LogifyApp.php');
    require_once('/LogifyReport.php');
    require_once('/Application.php');
    require_once('/ReportSender.php');

    class LogifyAlertClient {
        public $apiKey	='';
        public $appName ='';
        public $appVersion ='';	
        public $url = '';
        //$attachments ='';	
        //$customData ='';	
        //$instance ='';	
        //$OfflineReportsCount ='';	
        //$OfflineReportsDirectory ='';	
        //$OfflineReportsEnabled	
        public $userId ='';

        function send(Exception $exception){
            $sender = new ReportSender();
            $sender->API_key = $this->apiKey;
            $report = $this->GetLogifyReport();
            $report->AddException($exception);
            //echo '<pre>'.print_r($report->GetDataArray(),1).'</pre>';
            return $sender->send($this->url, $report->GetDataArray() );
        }
        function GetLogifyReport(){
            $report = new LogifyReport();
            $logifyApp = new LogifyApp();
            $logifyApp->name = 'Test PHP application for testing PHP logify alert client';
            $logifyApp->userId = 'php test user';
            $app = new Application();
            $app->name = 'Test PHP Application';
            $app->version = '1.0.0.0';
            $app->is64bit = false;
            $report->logifyApp = $logifyApp;
            $report->application = $app;

            return $report;
        }
    }
?>