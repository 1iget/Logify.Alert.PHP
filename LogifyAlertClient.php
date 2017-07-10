<?php
require_once(__DIR__.'/Collectors/Report.php');
require_once(__DIR__.'/ReportSender/ReportSender.php');

class LogifyAlertClient {
	public $apiKey;
	public $serviceUrl;
	public $attachments = null;
	public $customData = null;
	public $userId;
    public $globalVariablesPermissions = array();
    public $pathToConfigFile = '/config.php';
    public $appName;
    public $appVersion;

    static function get_instance(){
        if(!array_key_exists('LogifyAlertClient', $GLOBALS)){
            $GLOBALS['LogifyAlertClient'] = new LogifyAlertClient();
        }
        return $GLOBALS['LogifyAlertClient'];
    }
	function send(Exception $exception, $customData=null, $attachments = null){
		$this->configure();
		$sender = new ReportSender($this->apiKey, $this->serviceUrl);
		$report = new ReportCollector($exception, $this->globalVariablesPermissions, $this->userId, $this->appName, $this->appVersion);

        if($customData !== null){
            $this->customData = $customData;
        }
        if($attachments !== null){
            $this->attachments = $attachments;
        }
        $report->AddCustomData($this->customData);
        $report->AddAttachments($this->attachments);

		return $sender->send( $report->CollectData() );
	}
    function set_handlers(){
        $version = explode('.', PHP_VERSION)[0];
        if($version < 7){
            set_exception_handler(array($this, 'exception_handler'));
            set_error_handler(array($this, 'exception_error_handler'));
        }else{
            set_exception_handler(array($this, 'exception_handler_7'));
        }
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
		if(empty($this->appName)){
			$this->appName = $configs::appName;
		}
		if(empty($this->appVersion)){
			$this->appVersion = $configs::appVersion;
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
    function exception_error_handler($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) {
            return;
        }
        throw new ErrorException($message, 0, $severity, $file, $line);
    }
    function exception_handler(Exception $exception){
        $this->send($exception);
    }
    function exception_handler_7(Throwable $ex){
        echo '7';
    }
}
?>