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
        return $result;
    }
    private function GetEncodedContent(){
        $data = implode(array_map("chr", $this->content));
        return gzencode($data, 9);
    }
}
?>