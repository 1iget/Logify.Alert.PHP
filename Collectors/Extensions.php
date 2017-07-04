<?php
require_once(__DIR__.'/Interfaces.php');

class ExtensionsCollector implements iCollector {

    #region iCollector Members
	function DataName()	{
		return 'PHPLoadedExtensions';
	}

	public function CollectData() {
		$result = array();
		foreach(get_loaded_extensions() as $extension){
			$result[$extension] = phpversion($extension);
		}
		return $result;
	}
    #endregion
}
?>