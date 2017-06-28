<?php
require_once('/Interfaces.php');

class ExceptionCollector implements iCollector {
    public $type;
    public $message;
    public $stackTrace;
    public $normalizedStackTrace;
    public $code;
    public $file;
    public $line;

	function DataName()	{
		return 'exception';
	}

    public function CollectData(){
        $result = array(
            'type' => $this->type,
            'message' => $this->message,
            'code' => $this->code,
            'file' => $this->file,
            'line' => $this->line,
            //'stackTrace' => $this->stackTrace,
            'stackTrace' => 'stack',
            'normalizedStackTrace' => $this->normalizedStackTrace,
        );
        return array($result);
    }

    public static function GetInstance(Exception $e){
        $result = new ExceptionCollector();
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