<?php
include(__DIR__.'/../Collectors/Report.php');
class PermissionsTest extends PHPUnit_Framework_TestCase {
    private $report;
    const globalVariablesPermissions = array(
    'get' => true,
    'post' => true,
    'cookie' => true,
    'files' => true,
    'enviroment' => true,
    'request' => true,
    'server' => true,
    );

    public function testReportGlobalsNoGetStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => false,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ));
        $this->assertFalse(in_array('get', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoPostStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => false,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ));
        $this->assertFalse(in_array('post', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoCookieStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => false,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ));
        $this->assertFalse(in_array('cookie', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoFilesStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => false,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ));
        $this->assertFalse(in_array('files', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoEnviromentStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => false,
        'request' => true,
        'server' => true,
        ));
        $this->assertFalse(in_array('enviroment', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoRequestStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => false,
        'server' => true,
        ));
        $this->assertFalse(in_array('request', $this->report->CollectData()['globals']));
    }
    public function testReportGlobalsNoServerStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => true,
		'post' => true,
		'cookie' => true,
		'files' => true,
		'enviroment' => true,
		'request' => true,
		'server' => false,
        ));
        $this->assertFalse(in_array('server', $this->report->CollectData()['globals']));
    }
}
?>