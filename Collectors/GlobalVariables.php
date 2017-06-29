<?php
require_once('/Interfaces.php');
require_once('/Collectors/Variables.php');

class GlobalVariablesCollector implements iCollector {
	private $collectors = array();

	function __construct() {
		$this->collectors[] = new VariablesCollector('get', $_GET);
		$this->collectors[] = new VariablesCollector('post', $_POST);
		$this->collectors[] = new VariablesCollector('cookie', $_COOKIE);
		$this->collectors[] = new VariablesCollector('files', $_FILES);
		$this->collectors[] = new VariablesCollector('enviroment', $_ENV);
		$this->collectors[] = new VariablesCollector('request', $_REQUEST);
		$this->collectors[] = new VariablesCollector('server', $_SERVER);
	}

	#region iCollector Members

	function DataName()	{
		return 'globals';
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