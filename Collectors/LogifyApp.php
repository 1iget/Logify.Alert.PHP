<?php
    require_once('/Interfaces.php');

    class LogifyAppCollector implements iCollector{
        const version = '17.1';

        public $name;
        public $userId;

        public function CollectData(){
            $result = array(
                'name' => $this->name,
                'version' => self::version,
                'userId' => $this->userId,
            );
            return $result;
        }
    }
?>