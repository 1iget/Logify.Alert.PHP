<?php
require_once('/Interfaces.php');

class RequestVariablesCollector implements iCollector {

	#region iCollector Members

	function DataName()	{
		return 'requestVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_REQUEST as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion
}
?>