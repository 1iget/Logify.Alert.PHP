<?php
require_once('/Interfaces.php');
require_once('/Collectors/ProtocolVersion.php');
require_once('/Collectors/LogifyApp.php');
require_once('/Collectors/App.php');
require_once('/Collectors/Exception.php');
require_once('/Collectors/Browser.php');
require_once('/Collectors/GlobalVariables.php');
require_once('/Collectors/OS.php');
require_once('/Collectors/Memory.php');
require_once('/Collectors/DevPlatform.php');
require_once('/Collectors/Platform.php');

class ReportCollector implements iCollector {
	private $collectors = array();

	function __construct($exeption) {
		$this->collectors[] = new ProtocolVersionCollector();
		$this->collectors[] = new LogifyAppCollector();
		$this->collectors[] = new AppCollector();
		$this->collectors[] = ExceptionCollector::GetInstance($exeption);
		$this->collectors[] = new BrowserCollector();
		$this->collectors[] = new GlobalVariablesCollector();
		$this->collectors[] = new OSCollector();
		$this->collectors[] = new MemoryCollector();
		$this->collectors[] = new DevPlatformCollector();
		$this->collectors[] = new PlatformCollector();
	}

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
}
?>