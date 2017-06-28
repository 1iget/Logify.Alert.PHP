<?php
require_once('/Interfaces.php');

class GetVariablesCollector implements iCollector, iVariables {

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

	#region iVariables Members
	function HaveData()	{
		return !empty($_GET);
	}
	#endregion

}
?>