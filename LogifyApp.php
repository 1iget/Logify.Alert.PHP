<?php
    require_once('/Interfaces.php');

    class LogifyApp implements iData{
        const version = '17.1';

        public $name;
        public $userId;

        public function GetDataArray(){
            $result = array(
                'name' => $this->name,
                'version' => self::version,
                'userId' => $this->userId,
            );
            return $result;
        }
    }
?>