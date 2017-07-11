<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

class ExceptionCollector implements iCollector {
	public $exceptions = array();

    #region iCollector Members
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
			    'stackTrace' => $e->getTraceAsString(),
		    );
		}
        return $result;
    }
    #endregion

	public function AddException (\Exception $e){
		$this->exceptions[] = $e;
	}

    public static function GetInstance(\Exception $e){
        $result = new ExceptionCollector();
		$result->AddException($e);
        return $result;
    }

}
?>