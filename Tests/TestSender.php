<?php

require_once(__DIR__ . '/clientForTest.php');

class SenderTest extends PHPUnit_Framework_TestCase {

    private $client;
    protected function setUp() {
        $this->client = new LogifyAlertTestClient();
        $this->client->pathToConfigFile = __DIR__ . '/configForTest.php';
        $this->client->offlineReportsEnabled = true;
        
    }
    public function testCountException() {
        $this->client->send(new Exception('test exception1'));
        $this->client->send(new Exception('test exception2'));
        $this->client->send(new Exception('test exception3'));
        $this->client->send(new Exception('test exception4'));
        $this->client->send(new Exception('test exception5'));
        $reports = $this->client->get_saved_reports();
        $this->assertEquals(5, count($reports));
    }
    public function testOfflineException() {
        $this->client->send(new Exception('test exception'));
        $report = json_decode($this->client->get_saved_reports()[0], true);
        $this->assertEquals('test exception', $report['exception'][0]['message']);
    }
}

