<?php
require_once('/Interfaces.php');

class BrowserCollector implements iCollector {

	#region iCollector Members
	function DataName()	{
		return 'browser';
	}

	function CollectData()
	{
		return get_browser($_SERVER['HTTP_USER_AGENT'], true);
	}
	#endregion
}
?>