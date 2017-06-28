<?php
require_once('/Interfaces.php');

class PostVariablesCollector implements iCollector, iVariables {

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

	#region iVariables Members
	function HaveData()	{
		return !empty($_POST);
	}
	#endregion

}
?>