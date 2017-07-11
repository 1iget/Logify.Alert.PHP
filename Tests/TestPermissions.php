<?php
use DevExpress\Logify\Collectors\ReportCollector;

require_once(__DIR__.'/../Logify/LoadHelper.php');
spl_autoload_register(array("DevExpress\LoadHelper", "LoadModule"));

class PermissionsTest extends PHPUnit_Framework_TestCase {
    private $report;

    public function testReportGlobalsNoGetStructure(){
        $this->report = new ReportCollector(new Exception('test exception'), array(
        'get' => false,
        'post' => true,
        'cookie' => true,
        'files' => true,
        'enviroment' => true,
        'request' => true,
        'server' => true,
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('get', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('post', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('cookie', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('files', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('enviroment', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('request', $this->report->CollectData()['globals']));
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
        ), 'testuser', 'tests', 't.0');
        $this->assertFalse(array_key_exists('server', $this->report->CollectData()['globals']));
    }
}
?>