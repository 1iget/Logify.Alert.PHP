<?php
require_once('/Interfaces.php');

class EnviromentVariablesCollector implements iCollector, iVariables {

	#region iCollector Members

	function DataName()	{
		return 'enviromentVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_ENV as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion

	#region iVariables Members
	function HaveData()	{
		return !empty($_ENV);
	}
	#endregion

}
?>