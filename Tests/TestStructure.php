<?php
include(__DIR__.'/../Collectors/Report.php');
class StructureTest extends PHPUnit_Framework_TestCase {
    private $reportData;

    protected function setUp(){
        $report = new ReportCollector(new Exception('test exception'));
        $this->reportData = $report->CollectData();
    }
    public function testReportStructure(){
        $this->assertTrue(is_array($this->reportData));
    }
    public function testReportStructure2(){
        $this->assertEquals(11, count($this->reportData));
    }
}
?>