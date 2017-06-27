<?php
require_once('/Interfaces.php');
require_once('/LogifyException.php');

class LogifyExceptions implements iData {
    public $exceptions;

    public function GetDataArray(){
        $result = array();
        foreach($this->exceptions as $exception){
            array_push($result, $exception->GetDataArray());
        }
        return $result;
    }
}

?>