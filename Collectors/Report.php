<?php
require_once(__DIR__.'/Interfaces.php');
require_once(__DIR__.'/../Collectors/ProtocolVersion.php');
require_once(__DIR__.'/../Collectors/DateTime.php');
require_once(__DIR__.'/../Collectors/LogifyApp.php');
require_once(__DIR__.'/../Collectors/App.php');
require_once(__DIR__.'/../Collectors/Exception.php');
require_once(__DIR__.'/../Collectors/Extensions.php');
require_once(__DIR__.'/../Collectors/GlobalVariables.php');
require_once(__DIR__.'/../Collectors/OS.php');
require_once(__DIR__.'/../Collectors/Memory.php');
require_once(__DIR__.'/../Collectors/DevPlatform.php');
require_once(__DIR__.'/../Collectors/Platform.php');

class ReportCollector implements iCollector {
	private $collectors = array();

	function __construct($exeption, $globalVariablesPermissions, $userId, $appName, $appVersion) {
		$this->collectors[] = new ProtocolVersionCollector();
        $this->collectors[] = new DateTimeCollector();
		$this->collectors[] = new LogifyAppCollector($userId);
		$this->collectors[] = new AppCollector($appName, $appVersion);
		$this->collectors[] = ExceptionCollector::GetInstance($exeption);
		$this->collectors[] = new ExtensionsCollector();
		$this->collectors[] = new GlobalVariablesCollector($globalVariablesPermissions);
		$this->collectors[] = new OSCollector();
		$this->collectors[] = new MemoryCollector();
		$this->collectors[] = new DevPlatformCollector();
		$this->collectors[] = new PlatformCollector();
	}

    #region iCollector Members
	function DataName(){
		return '';
	}
	function CollectData()	{
		$result = array();
		foreach($this->collectors as $collector) {
			$result[$collector->DataName()] = $collector->CollectData();
		}
		return $result;
	}
    #endregion

    function AddAtachment($atachment){
        if($atachment === null){
            return;
        }

    }
}
?>