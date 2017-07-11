<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

class ReportCollector implements iCollector {
	private $collectors = array();

	function __construct($exeption, $globalVariablesPermissions, $userId, $appName, $appVersion) {
		$this->collectors[] = new ProtocolVersionCollector();
        $this->collectors[] = new DateTimeCollector();
		$this->collectors[] = new LogifyAppCollector($appName, $appVersion, $userId);
		$this->collectors[] = ExceptionCollector::GetInstance($exeption);
		$this->collectors[] = new ExtensionsCollector();
		$this->collectors[] = new GlobalVariablesCollector($globalVariablesPermissions);
		$this->collectors[] = new OSCollector();
		$this->collectors[] = new MemoryCollector();
		$this->collectors[] = new DevPlatformCollector();
		$this->collectors[] = new PlatformCollector();
	}

    #region iCollector Members
	function DataName(){
		return '';
	}
	function CollectData()	{
		$result = array();
		foreach($this->collectors as $collector) {
			$result[$collector->DataName()] = $collector->CollectData();
		}
		return $result;
	}
    #endregion

    function AddCustomData($customData){
        if($customData === null){
            return;
        }
        $this->collectors[] = new CustomDataCollector($customData);
    }
    function AddAttachments($attachments){
        if($attachments === null){
            return;
        }
        $this->collectors[] = new AttachmentsCollector($attachments);
    }
}
?>