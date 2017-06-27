<?php
require_once('/Interfaces.php');
 
class LogifyException implements iData {
    public $type;
    public $message;
    public $stackTrace;
    public $normalizedStackTrace;
    public $code;
    public $file;
    public $line;

    public function GetDataArray(){
        $result = array(
            'type' => $this->type,
            'message' => $this->message,
            'code' => $this->code,
            'file' => $this->file,
            'line' => $this->line,
            'stackTrace' => $this->stackTrace,
            'normalizedStackTrace' => $this->normalizedStackTrace,
        );
        return $result;
    }

    public static function GetInstance(Exception $e){
        $result = new LogifyException();
        $result->type = gettype($e);
        $result->message = $e->getMessage();
        $result->code = $e->getCode();
        $result->file = $e->getFile();
        $result->line = $e->getLine();
        $result->stackTrace = $e->getTrace();
        $result->normalizedStackTrace = $e->getTraceAsString();
        return $result;
    }
}
?>