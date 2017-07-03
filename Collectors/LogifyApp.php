<?php
require_once(__DIR__.'/Interfaces.php');

class LogifyAppCollector implements iCollector{
    const version = '17.1';
    const name = 'Test PHP application for testing PHP logify alert client';
    private $userId;

    function __construct($userId){
        $this->userId = $userId;
    }
    function DataName()	{
        return 'logifyApp';
    }

    public function CollectData(){
        $result = array(
            'name' => self::name,
            'version' => self::version,
            'userId' => $this->userId,
        );
        return $result;
    }
}
?>