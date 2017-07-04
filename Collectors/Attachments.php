<?php
require_once(__DIR__.'/Interfaces.php');
require_once(__DIR__.'/../Core/Attachment.php');
class AttachmentsCollector implements iCollector {

    public $attachments = array();

    function __construct($attachments){
        $this->attachments = $attachments;
    }

    #region iCollector Members
    function DataName()	{
        return 'attachments';
    }

    public function CollectData() {
        $result = array();
        foreach($this->attachments as $attachment){
            if($attachment instanceof Attachment){
                $result[]=$attachment->GetAttachmentData();
            }
        }
        return $result;
    }
    #endregion
}
?>