<?php
require_once(__DIR__.'/clientForTest.php');
class ClientTest extends PHPUnit_Framework_TestCase {
    //public $userId;
    //public $globalVariablesPermissions;

    private $client;

    protected function setUp(){
        $this->client =  new LogifyAlertTestClient();
        $this->client->pathToConfigFile = __DIR__.'/configForTest.php';
    }

    public function testConfigApiKey(){
        $this->client->configureCall();
        $this->assertEquals('configApiKey', $this->client->apiKey);
    }

    public function testClientApiKey(){
        $this->client->apiKey = 'clientApikey';
        $this->client->configureCall();
        $this->assertEquals('clientApikey', $this->client->apiKey);
    }
    public function testConfigUrl(){
        $this->client->configureCall();
        $this->assertEquals('configUrl', $this->client->serviceUrl);
    }
    public function testClientUrl(){
        $this->client->serviceUrl = 'clientUrl';
        $this->client->configureCall();
        $this->assertEquals('clientUrl', $this->client->serviceUrl);
    }
    public function testConfigUserId(){
        $this->client->configureCall();
        $this->assertEquals('configUserId', $this->client->userId);
    }
    public function testClientUserId(){
        $this->client->userId = 'clientUserId';
        $this->client->configureCall();
        $this->assertEquals('clientUserId', $this->client->userId);
    }
}
?>