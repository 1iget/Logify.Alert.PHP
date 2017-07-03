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
    public function testConfigPermissionsGet(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['get']);
    }
    public function testClientPermissionsGet(){
        $this->client->globalVariablesPermissions['get'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['get']);
    }
    public function testConfigPermissionsPost(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['post']);
    }
    public function testClientPermissionsPost(){
        $this->client->globalVariablesPermissions['post'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['post']);
    }
    public function testConfigPermissionsCookie(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['cookie']);
    }
    public function testClientPermissionsCookie(){
        $this->client->globalVariablesPermissions['cookie'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['cookie']);
    }
    public function testConfigPermissionsFiles(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['files']);
    }
    public function testClientPermissionsFiles(){
        $this->client->globalVariablesPermissions['files'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['files']);
    }
    public function testConfigPermissionsEnviroment(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['enviroment']);
    }
    public function testClientPermissionsEnviroment(){
        $this->client->globalVariablesPermissions['enviroment'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['enviroment']);
    }
    public function testConfigPermissionsRequest(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['request']);
    }
    public function testClientPermissionsRequest(){
        $this->client->globalVariablesPermissions['request'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['request']);
    }
    public function testConfigPermissionsServer(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['server']);
    }
    public function testClientPermissionsServer(){
        $this->client->globalVariablesPermissions['server'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['server']);
    }
}
?>