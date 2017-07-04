<?php
class Attachment {
    public $name;
    public $mimeType;
    public $content;

    function GetAttachmentData(){
        $result = array();
        $result['name'] = $this->name;
        $result['mimeType'] = $this->mimeType;
        $result['content'] = $this->GetEncodedContent();
        $result['compress'] = 'gzip';
    }
    private function GetEncodedContent(){
        
    }
}
?>