<?php
require_once('/Interfaces.php');

class OSCollector  implements iCollector {

	function DataName()	{
		return 'os';
	}

	function CollectData(){
		$platform = php_uname('s');
		$version = php_uname('r').'.'.php_uname('v');
		$is64bit = 'false';
		$architecture = php_uname('m');

		if($_SERVER["PROCESSOR_ARCHITECTURE"] == 'x64'){
			$is64bit = 'true';
		}
		return array(
			'platform' => $platform,
			'version' => $version,
			'is64bit' => $is64bit,
			'architecture' => $architecture,
		);
	}
}
?>