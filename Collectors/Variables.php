<?php
require_once('/Interfaces.php');

class VariablesCollector implements iCollector, iVariables {
	private $name;
	private $variables;

	function __construct($name, $variables) {
		$this->name = $name;
		$this->variables = $variables;
	}

	#region iCollector Members
	function DataName()	{
		return $this->name;
	}

	function CollectData()	{
		return $this->variables;
	}
	#endregion

	#region iVariables Members
	function HaveData()	{
		return !empty($this->variables);
	}
	#endregion

}
?>