<?php
    require_once('/Interfaces.php');

    class LogifyApp implements iData{
        public $name;
        public $version;
        public $userId;

        public function GetDataArray(){
            $result = array(
                'name' => $this->name,
                'version' => $this->version,
                'userId' => $this->userId,
            );
            return $result;
        }
    }
?>