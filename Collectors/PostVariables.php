<?php
require_once('/Interfaces.php');

class PostVariablesCollector implements iCollector {

	#region iCollector Members

	function DataName()	{
		return 'postVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_POST as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion
}
?>