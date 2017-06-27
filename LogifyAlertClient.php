<?php
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

        function send($report){
            require_once('/ReportSender.php');
            $sender = new ReportSender();
            $sender->API_key = $this->apiKey;
            return $sender->send($this->url, $report );
        }
    }
?>