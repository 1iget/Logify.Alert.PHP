<?php
namespace DevExpress\Logify\Collectors;
use DevExpress\Logify\Core\iCollector;

require_once(__DIR__.'/../Core/Interfaces.php');

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