<?php
    require_once('/Interfaces.php');

    class AppCollector implements iCollector {
        public $name;
        public $version;
        public $is64bit;

        public function CollectData() {
            $result = array(
                'name' => $this->name,
                'version' => $this->version,
                'is64bit' => $this->is64bit,
            );
            return $result;
        }
    }
?>