<?php
require_once(__DIR__.'/../Interfaces.php');

class DevPlatformCollector implements iCollector {

	#region iCollector Members
	function DataName()	{
		return 'devPlatform';
	}

	function CollectData()	{
		return 'dotnet';
	}
	#endregion
}
?>