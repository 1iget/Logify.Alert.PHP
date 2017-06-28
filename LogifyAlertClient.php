<?php
require_once('/Collectors/Report.php');
require_once('/ReportSender.php');

class LogifyAlertClient {
	public $apiKey	='';
	//$attachments ='';
	//$customData ='';
	//$instance ='';
	public $userId ='';

	function send(Exception $exception){
		$sender = new ReportSender();
		$sender->API_key = $this->apiKey;
		$report = new ReportCollector($exception);
		//echo '<pre>'.print_r($GLOBALS, 1).'</pre>';
		//echo '<pre>'.print_r($report->GetData(),1).'</pre>';
		return $sender->send( $report->CollectData() );
	}
}
?>