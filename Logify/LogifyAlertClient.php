<?php
namespace DevExpress\Logify;

use DevExpress\Logify\Collectors\ReportCollector;
use LogifyAlert;
use DevExpress\Logify\Core\ReportSender;

class LogifyAlertClient {
    #region static
    public static function get_instance(){
        if(!array_key_exists('LogifyAlertClient', $GLOBALS)){
            $GLOBALS['LogifyAlertClient'] = new LogifyAlertClient();
        }
        return $GLOBALS['LogifyAlertClient'];
    }
    #endregion

    #region fields
    private $customDataHandler = null;
    private $attachmentsHandler = null;
    #endregion

    #region Properties
	public $apiKey;
    public $appName;
    public $appVersion;
	public $attachments = null;
	public $customData = null;
	public $userId;
    public $globalVariablesPermissions = array();
    public $pathToConfigFile = '/config.php';
	public $serviceUrl;
    #endregion

	public function send($exception, $customData=null, $attachments = null){
		$this->configure();
		$sender = new ReportSender($this->apiKey, $this->serviceUrl);
        $report = $this->get_ReportCollector($exception, $customData, $attachments);
		return $sender->send( $report->CollectData() );
	}

    #region Exception Handlers
    public function set_handlers(){
        set_exception_handler(array($this, 'exception_handler'));
        set_error_handler(array($this, 'error_handler'));
    }
    public function restore_handlers(){
        restore_exception_handler();
        restore_error_handler();
    }
    public function error_handler($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) {
            return;
        }
        $this->send(new \ErrorException($message, 0, $severity, $file, $line));
    }
    public function exception_handler($exception){
        $this->send($exception);
    }
    #endregion

    #region Configure
	protected function configure() {
		$included = include_once($this->pathToConfigFile);
        if(!$included){
            return;
        }
		$configs = new LogifyAlert();
		if(empty($this->apiKey) && key_exists('apiKey', $configs->settings)){
			$this->apiKey = $configs->settings['apiKey'];
		}
		if(empty($this->serviceUrl) && key_exists('serviceUrl', $configs->settings)){
			$this->serviceUrl = $configs->settings['serviceUrl'];
		}
		if(empty($this->userId) && key_exists('userId', $configs->settings)){
			$this->userId = $configs->settings['userId'];
		}
		if(empty($this->appName) && key_exists('appName', $configs->settings)){
			$this->appName = $configs->settings['appName'];
		}
		if(empty($this->appVersion) && key_exists('appVersion', $configs->settings)){
			$this->appVersion = $configs->settings['appVersion'];
		}
        $this->configureGlobalVariablesPermissions($configs);
	}
    protected function get_ReportCollector($exception, $customData=null, $attachments = null){
        $report = new ReportCollector($exception, $this->globalVariablesPermissions, $this->userId, $this->appName, $this->appVersion);

        if($customData !== null){
            $this->customData = $customData;
        }elseif($this->customDataHandler !== null && $this->customData === null){
            $userCustomData=call_user_func($this->customDataHandler);
            if($userCustomData !== null){
                $this->customData = $userCustomData;
            }
        }

        if($attachments !== null){
            $this->attachments = $attachments;
        }elseif($this->attachmentsHandler !== null && $this->attachments === null){
            $userAttachments=call_user_func($this->attachmentsHandler);
            if($userAttachments !== null){
                $this->attachments = $userAttachments;
            }
        }

        $report->AddCustomData($this->customData);
        $report->AddAttachments($this->attachments);
        return $report;
    }
    private function configureGlobalVariablesPermissions($configs){
        if(!is_array($this->globalVariablesPermissions)){
            $this->globalVariablesPermissions = array();
        }
        $this->collectGlobalVariablesPermissions('get', $configs);
        $this->collectGlobalVariablesPermissions('post', $configs);
        $this->collectGlobalVariablesPermissions('cookie', $configs);
        $this->collectGlobalVariablesPermissions('files', $configs);
        $this->collectGlobalVariablesPermissions('environment', $configs);
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
    #endregion

    #region CustomDataCallback
    public function set_CustomData_Callback(callable $customDataHandler){
        $this->customDataHandler = $customDataHandler;
    }
    #endregion

    #region AttachmentCallback
    public function set_Attachments_Callback(callable $attachmentsHandler){
        $this->attachmentsHandler = $attachmentsHandler;
    }
    #endregion
}
?>