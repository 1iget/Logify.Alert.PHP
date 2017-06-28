<?php
require_once('/LogifyReport.php');
require_once('/ReportSender.php');

class LogifyAlertClient {
	public $apiKey	='';
	public $url = '';
	//$attachments ='';
	//$customData ='';
	//$instance ='';
	public $userId ='';

	function send(Exception $exception){
		$sender = new ReportSender();
		$sender->API_key = $this->apiKey;
		$report = $this->GetLogifyReport();
		$report->AddException($exception);
		//echo '<pre>'.print_r($GLOBALS, 1).'</pre>';
		//echo '<pre>'.print_r($report->GetData(),1).'</pre>';
		return $sender->send($this->url, $report->GetData() );
	}
	function GetLogifyReport(){
		$report = new LogifyReport();

		return $report;
	}
}
?>