<?php
require_once('/Interfaces.php');

class FilesVariablesCollector implements iCollector, iVariables {

	#region iCollector Members

	function DataName()	{
		return 'filesVariables';
	}

	function CollectData()	{
		$result = array();
		foreach($_FILES as $key=>$value){
			$result[$key] = $value;
		}
		return $result;
	}

	#endregion

	#region iVariables Members
	function HaveData()	{
		return !empty($_FILES);
	}
	#endregion

}
?>