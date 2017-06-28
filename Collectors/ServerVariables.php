<?php
require_once('/Interfaces.php');

class ServerVariablesCollector implements iCollector, iVariables {

	#region iCollector Members

	function DataName()	{
		return 'serverVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_SERVER as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion

	#region iVariables Members
	function HaveData()	{
		return !empty($_SERVER);
	}
	#endregion
}
?>