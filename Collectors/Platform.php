<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

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