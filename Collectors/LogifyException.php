<?php
require_once('/Interfaces.php');

class ExceptionCollector implements iCollector {
	public $exceptions = array();

	function DataName()	{
		return 'exception';
	}

    public function CollectData(){
        $result = array();
		foreach($this->exceptions as $e){
			$result[] = array(
	            'type' =>  get_class($e),
		        'message' => $e->getMessage(),
			    'code' => $e->getCode(),
				'file' => $e->getFile(),
	            'line' =>$e->getLine(),
		        //'stackTrace' => $e->getTrace(),
			    'stackTrace' => 'stack',
				'normalizedStackTrace' => $e->getTraceAsString(),
				//'inner' => $this->innerE,
		    );
		}
        return $result;
    }
	public function AddException (Exception $e){
		$this->exceptions[] = $e;
		//$result->innerE = $e->detail->ExceptionDetail->InnerException->Message;
	}

    public static function GetInstance(Exception $e){
        $result = new ExceptionCollector();
		$result->AddException($e);
        return $result;
    }

}
?>