<?php
require_once(__DIR__.'/Interfaces.php');

class AppCollector implements iCollector {
    public $name = 'Test PHP Application';
    public $version = '1.0.0.0';

    function __construct($name, $version){
        $this->name = $name;
        $this->version = $version;
    }

    function DataName()	{
        return 'app';
    }

    public function CollectData() {
        $result = array(
            'name' => $this->name,
            'version' => $this->version,
        );
        return $result;
    }
}
?>