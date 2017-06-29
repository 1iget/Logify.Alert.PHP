<?php
require_once('/Interfaces.php');

class ExtensionsCollector implements iCollector {

	function DataName()	{
		return 'PHPLoadedExtensions';
	}

	public function CollectData() {
		$result = array();
		foreach(get_loaded_extensions() as $extesion){
			$result[$extesion] = phpversion($extesion);
		}
		return $result;
	}
}
?>