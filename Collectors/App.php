<?php
require_once('/Interfaces.php');

class AppCollector implements iCollector {
    const name = 'Test PHP Application';
    const version = '1.0.0.0';

    function DataName()	{
        return 'app';
    }

    public function CollectData() {
        $result = array(
            'name' => self::name,
            'version' => self::version,
            'is64bit' => !$this->is_32bit(),
        );
        return $result;
    }
    function is_32bit(){
        return PHP_INT_SIZE === 4;
    }
}
?>