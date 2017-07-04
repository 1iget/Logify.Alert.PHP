<?php
require_once(__DIR__.'/Interfaces.php');

class DateTimeCollector implements iCollector {

    #region iCollector Members
    function DataName()	{
        return 'logifyReportDateTimeUtc';
    }

    public function CollectData() {
        return gmdate('c');
    }
    #endregion
}
?>