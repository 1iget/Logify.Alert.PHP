<?php
use DevExpress\Logify\Collectors\ReportCollector;
use DevExpress\Logify\Core\Attachment;

require_once(__DIR__.'/../Logify/LoadHelper.php');
spl_autoload_register(array("DevExpress\LoadHelper", "LoadModule"));

class StructureTest extends PHPUnit_Framework_TestCase {
    private $report;
    private $reportData;
    protected function setUp(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'environment' => true,
        'request' => true,
        'server' => true,
        ), true,'testuser', 'tests', 't.0');
        $_SERVER['HTTP_USER_AGENT'] = 'testuseragent';
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
    public function testReportStructureCollectExtensions(){
        $attachment = new Attachment();
        $attachment->content = 'testAttachment';
        $attachment->mimeType = 'mime/text';
        $attachment->name = 'text';
        $this->report = new ReportCollector(new Exception('test exception'), array(
            'get' => true,
            'post' => true,
            'cookie' => true,
            'files' => true,
            'environment' => true,
            'request' => true,
            'server' => true,
            ), false,'testuser', 'tests', 't.0');
        $_SERVER['HTTP_USER_AGENT'] = 'testuseragent';
        $this->report->AddCustomData('customData');
        $this->report->AddAttachments(array($attachment));

        $this->reportData = $this->report->CollectData();
        $this->assertEquals(12, count($this->reportData));
    }
    public function testReportCustomData(){
        $this->report->AddCustomData(array('custom1' => 'data1', 'custom2' => 'data2'));
        $this->reportData = $this->report->CollectData();
        $this->assertEquals(array('custom1' => 'data1', 'custom2' => 'data2'), $this->reportData['customData']);
    }
}
?>