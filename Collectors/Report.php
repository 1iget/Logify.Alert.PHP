<?php
require_once('/Interfaces.php');

class ReportCollector implements iCollector {
	private $collectors = array();

	function DataName(){
		return '';
	}
	function CollectData()	{
		$result = array();
		foreach($this->collectors as $collector) {
			$result[$collector->DataName()] = $collector->CollectData();
		}
		return $result;
	}

	function AddCollector(iCollector $collector){
		array_push($this->collectors, $collector);
	}
}
?>