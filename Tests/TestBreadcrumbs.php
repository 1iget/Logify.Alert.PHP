<?php

require_once(__DIR__ . '/clientForTest.php');

class BreadcrumbsTest extends PHPUnit_Framework_TestCase {

    private $client;
    
    protected function setUp() {
        $this->client = new LogifyAlertTestClient();
        $GLOBALS['LogifyAlertClient'] = $this->client;
        $this->client->pathToConfigFile = __DIR__ . '/configForTest.php';
        $this->client->configureCall();
    }
    public function testBreadcrumbsMaxCountConfig() {
        $this->assertEquals(100, $this->client->breadcrumbsMaxCount);
    }
    public function testBreadcrumbsAdd() {
        $this->client->breadcrumbs->add("testbreadcrumb");
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals(1, count($testbreadcrumbs));
    }
    public function testBreadcrumbsClear() {
        $this->client->breadcrumbs->add("testbreadcrumb");
        $this->client->breadcrumbs->clear();
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals(null, $testbreadcrumbs);
    }
    public function testBreadcrumbsMaxSize() {
        $this->client->breadcrumbsMaxCount = 3;
        $this->client->breadcrumbs->add("testbreadcrumb1");
        $this->client->breadcrumbs->add("testbreadcrumb2");
        $this->client->breadcrumbs->add("testbreadcrumb3");
        $this->client->breadcrumbs->add("testbreadcrumb4");
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals($this->client->breadcrumbsMaxCount, count($testbreadcrumbs));
    }
    public function testBreadcrumbsChangeMaxSize() {
        $this->client->breadcrumbs->add("testbreadcrumb1");
        $this->client->breadcrumbs->add("testbreadcrumb2");
        $this->client->breadcrumbs->add("testbreadcrumb3");
        $this->client->breadcrumbs->add("testbreadcrumb4");
        $this->client->breadcrumbsMaxCount = 3;
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals($this->client->breadcrumbsMaxCount, count($testbreadcrumbs));
    }
    public function testBreadcrumbsMaxSizeNameOfLast() {
        $this->client->breadcrumbsMaxCount = 3;
        $this->client->breadcrumbs->add("testbreadcrumb1");
        $this->client->breadcrumbs->add("testbreadcrumb2");
        $this->client->breadcrumbs->add("testbreadcrumb3");
        $this->client->breadcrumbs->add("testbreadcrumb4");
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals("testbreadcrumb4", $testbreadcrumbs[2]->message);
    }
    public function testBreadcrumbsChangeMaxSizeNameOfLast() {
        $this->client->breadcrumbs->add("testbreadcrumb1");
        $this->client->breadcrumbs->add("testbreadcrumb2");
        $this->client->breadcrumbs->add("testbreadcrumb3");
        $this->client->breadcrumbs->add("testbreadcrumb4");
        $this->client->breadcrumbsMaxCount = 3;
        $testbreadcrumbs = $this->client->breadcrumbs->get();
        $this->assertEquals("testbreadcrumb4", $testbreadcrumbs[2]->message);
    }
}