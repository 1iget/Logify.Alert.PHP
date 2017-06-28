<?php
require_once('/Interfaces.php');
require_once('/Collectors/GetVariables.php');
require_once('/Collectors/PostVariables.php');
require_once('/Collectors/CookieVariables.php');
require_once('/Collectors/FilesVariables.php');
require_once('/Collectors/EnviromentVariables.php');
require_once('/Collectors/RequestVariables.php');
require_once('/Collectors/ServerVariables.php');
require_once('/Collectors/Browser.php');

class GlobalVariablesCollector implements iCollector {
	private $collectors = array();

	function __construct() {
		//$variables[] = new BrowserCollector();
		$this->collectors[] = new GetVariablesCollector();
		$this->collectors[] = new PostVariablesCollector();
		$this->collectors[] = new CookieVariablesCollector();
		$this->collectors[] = new FilesVariablesCollector();
		$this->collectors[] = new EnviromentVariablesCollector();
		$this->collectors[] = new RequestVariablesCollector();
		$this->collectors[] = new ServerVariablesCollector();
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
		////$browserCollector = new BrowserCollector();
		//$getCollector = new GetVariablesCollector();
		//$postCollector = new PostVariablesCollector();
		//$cookieCollector = new CookieVariablesCollector();
		//$filesCollector = new FilesVariablesCollector();
		//$enviromentCollector = new EnviromentVariablesCollector();
		//$requestCollector = new RequestVariablesCollector();
		//$serverCollector = new ServerVariablesCollector();

		////$result[$browserCollector->DataName()] = $browserCollector->CollectData();
		//$result[$getCollector->DataName()] = $getCollector->CollectData();
		//$result[$postCollector->DataName()] = $postCollector->CollectData();
		//$result[$cookieCollector->DataName()] = $cookieCollector->CollectData();
		//$result[$filesCollector->DataName()] = $filesCollector->CollectData();
		//$result[$enviromentCollector->DataName()] = $enviromentCollector->CollectData();
		//$result[$requestCollector->DataName()] = $requestCollector->CollectData();
		//$result[$serverCollector->DataName()] = $serverCollector->CollectData();

		return $result;
	}

	#endregion
}
?>