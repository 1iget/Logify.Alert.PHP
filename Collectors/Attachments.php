<?php
require_once(__DIR__.'/Interfaces.php');

class AttachmentsCollector implements iCollector {

    public $attachments;
    
    function __construct($attachments){
        $this->attachments = $attachments;
    }

    #region iCollector Members
    function DataName()	{
        return 'attachments';
    }

    public function CollectData() {
    }
    #endregion
}
?>