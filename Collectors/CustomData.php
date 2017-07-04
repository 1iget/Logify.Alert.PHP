<?php
require_once(__DIR__.'/Interfaces.php');

class CustomDataCollector implements iCollector {

    public $customData;

    function __construct($customData){
        $this->customData = $customData;
    }

    #region iCollector Members
    function DataName()	{
        return 'customData';
    }

    public function CollectData() {
    }
    #endregion
}
?>