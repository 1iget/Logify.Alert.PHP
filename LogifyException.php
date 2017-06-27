<?php
require_once('/Interfaces.php');
 
class LogifyException implements iData {
    public $type;
    public $message;
    public $stackTrace;
    public $normalizedStackTrace;

    public function GetDataArray(){
        $result = array(
            'type' => $this->type,
            'message' => $this->message,
            'stackTrace' => $this->stackTrace,
            'normalizedStackTrace' => $this->normalizedStackTrace,
        );
        return $result;
    }
}
?>