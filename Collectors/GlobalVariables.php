<?php
require_once('/Interfaces.php');
require_once('/Collectors/Variables.php');
require_once('/Collectors/Browser.php');

class GlobalVariablesCollector implements iCollector {
	private $collectors = array();

	function __construct() {
		//$variables[] = new BrowserCollector();
		$this->collectors[] = new VariablesCollector('getVariables', $_GET);
		$this->collectors[] = new VariablesCollector('postVariables', $_POST);
		$this->collectors[] = new VariablesCollector('cookieVariables', $_COOKIE);
		$this->collectors[] = new VariablesCollector('filesVariables', $_FILES);
		$this->collectors[] = new VariablesCollector('enviromentVariables', $_ENV);
		$this->collectors[] = new VariablesCollector('requestVariables', $_REQUEST);
		$this->collectors[] = new VariablesCollector('serverVariables', $_SERVER);
	}

	#region iCollector Members

	function DataName()	{
		return 'globalVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($this->collectors as $collector) {
			if($collector->HaveData()) {
				$result[$collector->DataName()] = $collector->CollectData();
			}
		}
		return $result;
	}

	#endregion
}
?>