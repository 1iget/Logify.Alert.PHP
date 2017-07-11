<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

class ProtocolVersionCollector implements iCollector {

	#region iCollector Members

	function DataName()	{
		return 'logifyProtocolVersion';
	}

	function CollectData() {
		return '17.1';
	}

	#endregion
}
?>