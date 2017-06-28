<?php
require_once('/Interfaces.php');

class GetVariablesCollector implements iCollector {

	#region iCollector Members

	function DataName()	{
		return 'getVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_GET as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion
}
?>