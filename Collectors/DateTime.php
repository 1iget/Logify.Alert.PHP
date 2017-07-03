<?php
require_once(__DIR__.'/Interfaces.php');

class DateTimeCollector implements iCollector {
    function DataName()	{
        return 'logifyReportDateTimeUtc';
    }

    public function CollectData() {
        return gmdate('c');
    }
    function is_32bit(){
        return PHP_INT_SIZE === 4;
    }
}
?>