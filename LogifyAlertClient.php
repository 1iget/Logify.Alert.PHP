<?php
require_once(__DIR__.'/Collectors/Report.php');
require_once(__DIR__.'/ReportSender/ReportSender.php');

class LogifyAlertClient {
	public $apiKey;
	public $serviceUrl;
	//$attachments ='';
	//$customData ='';
	//$instance ='';
	public $userId;
    public $globalVariablesPermissions = array();
    public $pathToConfigFile = '/config.php';

	function send(Exception $exception){
		$this->configure();
		$sender = new ReportSender($this->apiKey, $this->serviceUrl);
		$report = new ReportCollector($exception, $this->globalVariablesPermissions, $this->userId);
		return $sender->send( $report->CollectData() );
	}
	protected function configure() {
		include_once($this->pathToConfigFile);
		$configs = new LogifyAlert();
		if(empty($this->apiKey)){
			$this->apiKey = $configs::apiKey;
		}
		if(empty($this->serviceUrl)){
			$this->serviceUrl = $configs::serviceUrl;
		}
		if(empty($this->userId)){
			$this->userId = $configs::userId;
		}
        $this->configureGlobalVariablesPermissions($configs);
	}
    private function configureGlobalVariablesPermissions($configs){
        if(!is_array($this->globalVariablesPermissions)){
            $this->globalVariablesPermissions = array();
        }
        $this->collectGlobalVariablesPermissions('get', $configs);
        $this->collectGlobalVariablesPermissions('post', $configs);
        $this->collectGlobalVariablesPermissions('cookie', $configs);
        $this->collectGlobalVariablesPermissions('files', $configs);
        $this->collectGlobalVariablesPermissions('enviroment', $configs);
        $this->collectGlobalVariablesPermissions('request', $configs);
        $this->collectGlobalVariablesPermissions('server', $configs);
    }
    private function collectGlobalVariablesPermissions($name, $configs){
        if( !array_key_exists($name, $configs->globalVariablesPermissions) || $configs->globalVariablesPermissions[$name] === null ){
            return;
        }
        if( !array_key_exists($name, $this->globalVariablesPermissions) || $this->globalVariablesPermissions[$name] === null ){
            $this->globalVariablesPermissions[$name] = $configs->globalVariablesPermissions[$name];
        }
    }
}
?>