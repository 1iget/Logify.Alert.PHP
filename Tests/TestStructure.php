<?php
include(__DIR__.'/../Collectors/Report.php');
include_once(__DIR__.'/../Core/Attachment.php');

class StructureTest extends PHPUnit_Framework_TestCase {
    private $report;
    private $reportData;
    protected function setUp(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ), 'testuser', 'tests', 't.0');
        $this->reportData = $this->report->CollectData();
    }
    public function testReportStructure(){
        $this->assertTrue(is_array($this->reportData));
    }
    public function testReportStructure2(){
        $this->assertEquals(11, count($this->reportData));
    }
    public function testReportStructure3(){
        $this->report->AddCustomData('customData');
        $this->reportData = $this->report->CollectData();
        $this->assertEquals(12, count($this->reportData));
    }
    public function testReportStructure4(){
        $attachment = new Attachment();
        $attachment->content = 'testAttachment';
        $attachment->mimeType = 'mime/text';
        $attachment->name = 'text';
        $this->report->AddAttachments(array($attachment));
        $this->reportData = $this->report->CollectData();
        $this->assertEquals(12, count($this->reportData));
    }
    public function testReportStructure5(){
        $attachment = new Attachment();
        $attachment->content = 'testAttachment';
        $attachment->mimeType = 'mime/text';
        $attachment->name = 'text';

        $this->report->AddCustomData('customData');
        $this->report->AddAttachments(array($attachment));
        $this->reportData = $this->report->CollectData();
        $this->assertEquals(13, count($this->reportData));
    }
    public function testReportCustomData(){
        $this->report->AddCustomData(array('custom1' => 'data1', 'custom2' => 'data2'));
        $this->reportData = $this->report->CollectData();
        $this->assertEquals(array('custom1' => 'data1', 'custom2' => 'data2'), $this->reportData['customData']);
    }
}
?>