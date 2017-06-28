<?php
require_once('/Interfaces.php');

class CookieVariablesCollector implements iCollector {

	#region iCollector Members

	function DataName()	{
		return 'cookieVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_COOKIE as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion
}
?>