<?php
require_once('/Interfaces.php');

class CookieVariablesCollector implements iCollector, iVariables {

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

	#region iVariables Members
	function HaveData()	{
		return !empty($_COOKIE);
	}
	#endregion

}
?>