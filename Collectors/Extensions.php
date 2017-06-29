<?php
require_once('/Interfaces.php');
class ExtensionsCollector implements iCollector {

	#region iCollector Members
	function DataName() {
		return 'loadedExtensions';
	}

	function CollectData() {
		return get_loaded_extensions();
	}

	#endregion
}
?>