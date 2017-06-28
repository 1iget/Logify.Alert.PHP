<?php
class PlatformCollector implements iCollector {
	#region iCollector Members
	function DataName()	{
		return 'platform';
	}

	function CollectData()	{
		return 'PHP';
	}
	#endregion
}
?>