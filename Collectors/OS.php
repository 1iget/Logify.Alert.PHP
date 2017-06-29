<?php
require_once('/Interfaces.php');

class OSCollector  implements iCollector {

	function DataName()	{
		return 'os';
	}

	function CollectData(){
		$platform = php_uname('s');
		$version = php_uname('r').'. '.php_uname('v');
		$is64bit = !$this->is_32bit();
		$architecture = php_uname('m');

		return array(
			'platform' => $platform,
			'version' => $version,
			'is64bit' => $is64bit,
			'architecture' => $architecture,
		);
	}
	function is_32bit(){
		return PHP_INT_SIZE === 4;
	}
}
?>