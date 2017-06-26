<?php
    class LogifyAlertClient {
        public $apiKey	='2F7B18D129F940E0A512956BF4AB9561';
        public $appName ='';
        public $appVersion ='';	
        public $url = 'http://logify.devexpress.com/api/report/newreport';
        //$attachments ='';	
        //$customData ='';	
        //$instance ='';	
        //$OfflineReportsCount ='';	
        //$OfflineReportsDirectory ='';	
        //$OfflineReportsEnabled	
        public $userId ='';

        function send($exception){
            require_once('/ReportSender.php');
            $sender = new ReportSender();
            $sender->API_key = $this->apiKey;
            return $sender->send($this->url, $exception );
        }
    }
?>