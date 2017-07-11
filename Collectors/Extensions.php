<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

class ExtensionsCollector implements iCollector {

    #region iCollector Members
	function DataName()	{
		return 'PHPLoadedExtensions';
	}

	public function CollectData() {
		$result = array();
		foreach(get_loaded_extensions() as $extension){
            $version = phpversion($extension);
            if(!$version){
                $version = '';
            }
			$result[$extension] = $version;
		}
		return $result;
	}
    #endregion
}
?>