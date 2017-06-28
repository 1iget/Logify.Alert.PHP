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

	#region iCollector Members

	function DataName()	{
		return 'gloabalVariables';
	}

	function CollectData()	{
		$result = array();
		//$browserCollector = new BrowserCollector();
		$getCollector = new GetVariablesCollector();
		$postCollector = new PostVariablesCollector();
		$cookieCollector = new CookieVariablesCollector();
		$filesCollector = new FilesVariablesCollector();
		$enviromentCollector = new EnviromentVariablesCollector();
		$requestCollector = new RequestVariablesCollector();
		$serverCollector = new ServerVariablesCollector();

		//$result[$browserCollector->DataName()] = $browserCollector->CollectData();
		$result[$getCollector->DataName()] = $getCollector->CollectData();
		$result[$postCollector->DataName()] = $postCollector->CollectData();
		$result[$cookieCollector->DataName()] = $cookieCollector->CollectData();
		$result[$filesCollector->DataName()] = $filesCollector->CollectData();
		$result[$enviromentCollector->DataName()] = $enviromentCollector->CollectData();
		$result[$requestCollector->DataName()] = $requestCollector->CollectData();
		$result[$serverCollector->DataName()] = $serverCollector->CollectData();

		return $result;
	}

	#endregion
}
?>