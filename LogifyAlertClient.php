<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Collectors/Report.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ReportSender.php');

class LogifyAlertClient {
	public $apiKey;
	public $serviceUrl;
	//$attachments ='';
	//$customData ='';
	//$instance ='';
	public $userId;

	function send(Exception $exception){
		$this->configure();
		$sender = new ReportSender($this->apiKey, $this->serviceUrl);
		$report = new ReportCollector($exception);
		return $sender->send( $report->CollectData() );
	}
	function configure() {
		include('/config.php');
		$configs = new LogifyAlert();
		if(empty($this->apiKey)){
			$this->apiKey = $configs::apiKey;
		}
		if(empty($this->serviceUrl)){
			$this->serviceUrl = $configs::serviceUrl;
		}
	}
}
?>