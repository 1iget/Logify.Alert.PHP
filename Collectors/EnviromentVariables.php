<?php
require_once('/Interfaces.php');

class EnviromentVariablesCollector implements iCollector {

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
}
?>