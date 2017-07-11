<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

class DevPlatformCollector implements iCollector {

	#region iCollector Members
	function DataName()	{
		return 'devPlatform';
	}

	function CollectData()	{
		return 'php';
	}
	#endregion
}
?>