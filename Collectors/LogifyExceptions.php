<?php
require_once('/Interfaces.php');
require_once('/LogifyException.php');

class ExceptionsCollector implements iCollector {
    public $exceptions;

    public function CollectData(){
        $result = array();
        foreach($this->exceptions as $exception){
            array_push($result, $exception->CollectData());
        }
        return $result;
    }
}

?>