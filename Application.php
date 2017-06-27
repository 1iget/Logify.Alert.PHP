<?php
    require_once('/Interfaces.php');

    class Application implements iData{
        public $name;
        public $version;
        public $is64bit;

        public function GetDataArray(){
            $result = array(
                'name' => $this->name,
                'version' => $this->version,
                'is64bit' => $this->is64bit,
            );
            return $result;
        }
    }
?>