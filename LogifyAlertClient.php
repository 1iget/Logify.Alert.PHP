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
    public $globalVariablesPermissions;

	function send(Exception $exception){
		$this->configure();
		$sender = new ReportSender($this->apiKey, $this->serviceUrl);
		$report = new ReportCollector($exception, $this->globalVariablesPermissions);
		return $sender->send( $report->CollectData() );
	}
	private function configure() {
		include('/config.php');
		$configs = new LogifyAlert();
		if(empty($this->apiKey)){
			$this->apiKey = $configs::apiKey;
		}
		if(empty($this->serviceUrl)){
			$this->serviceUrl = $configs::serviceUrl;
		}
        $this->configureGlobalVariablesPermissions($configs);
	}
    private function configureGlobalVariablesPermissions($configs){
        if(!is_array($this->globalVariablesPermissions)){
            $this->globalVariablesPermissions = array();
        }
        $this->collectGlobalVariablesPermissions('get', $configs::allowCollectGetVariables);
        $this->collectGlobalVariablesPermissions('post', $configs::allowCollectPostVariables);
        $this->collectGlobalVariablesPermissions('cookie', $configs::allowCollectCookieVariables);
        $this->collectGlobalVariablesPermissions('files', $configs::allowCollectFilesVariables);
        $this->collectGlobalVariablesPermissions('enviroment', $configs::allowCollectEnviromentVariables);
        $this->collectGlobalVariablesPermissions('request', $configs::allowCollectRequestVariables);
        $this->collectGlobalVariablesPermissions('server', $configs::allowCollectServerVariables);
    }
    private function collectGlobalVariablesPermissions($name, $value){
        if( !in_array($name, $this->globalVariablesPermissions) || $this->globalVariablesPermissions[$name] == null ){
            $this->globalVariablesPermissions[$name] = $value;
        }
    }
}
?>