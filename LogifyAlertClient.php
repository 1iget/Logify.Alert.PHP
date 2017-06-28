<?php
require_once('/Collectors/LogifyApp.php'); // must remove
require_once('/Collectors/App.php');       // must remove
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
		//echo '<pre>'.print_r($report->CollectData(),1).'</pre>';
		return $sender->send($this->url, $report->CollectData() );
	}
	function GetLogifyReport(){
		$report = new LogifyReport();
		$logifyApp = new LogifyAppCollector();
		$logifyApp->name = 'Test PHP application for testing PHP logify alert client';
		$logifyApp->userId = 'php test user';
		$app = new AppCollector();
		$app->name = 'Test PHP Application';
		$app->version = '1.0.0.0';
		$app->is64bit = false;
		$report->logifyApp = $logifyApp;
		$report->application = $app;

		return $report;
	}
}
?>