<?php
use DevExpress\Logify\Core\Attachment;
require_once(__DIR__.'/clientForTest.php');
class ConfigTest extends PHPUnit_Framework_TestCase {
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
    public function testConfigPermissionsEnvironment(){
        $this->client->configureCall();
        $this->assertTrue($this->client->globalVariablesPermissions['environment']);
    }
    public function testClientPermissionsEnvironment(){
        $this->client->globalVariablesPermissions['environment'] = false;
        $this->client->configureCall();
        $this->assertFalse($this->client->globalVariablesPermissions['environment']);
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
    public function testConfigAppName(){
        $this->client->configureCall();
        $this->assertEquals('tests', $this->client->appName);
    }
    public function testCLientAppName(){
        $this->client->appName = 'clientTests';
        $this->client->configureCall();
        $this->assertEquals('clientTests', $this->client->appName);
    }
    public function testConfigAppVersion(){
        $this->client->configureCall();
        $this->assertEquals('t.0', $this->client->appVersion);
    }
    public function testCLientAppVersion(){
        $this->client->appVersion = 'client.t.0';
        $this->client->configureCall();
        $this->assertEquals('client.t.0', $this->client->appVersion);
    }

    public function testClientCustomData(){
        $this->client->customData = array('testCustomData' => 'clientCustomData');
        $this->client->set_CustomData_Callback(array($this,'callback_Custom_Data'));
        $reportData = $this->client->getReport(null, null)->CollectData();
        $this->assertEquals('clientCustomData', $reportData['customData']['testCustomData']);
    }
    public function testCallBackCustomData(){
        $this->client->set_CustomData_Callback(array($this,'callback_Custom_Data'));
        $reportData = $this->client->getReport(null, null)->CollectData();
        $this->assertEquals('callbackCustomData', $reportData['customData']['testCustomData']);
    }
    public function testSendCustomData(){
        $this->client->customData = array('testCustomData' => 'clientCustomData');
        $this->client->set_CustomData_Callback(array($this,'callback_Custom_Data'));
        $reportData = $this->client->getReport(array('testCustomData' => 'sendCustomData'), null)->CollectData();
        $this->assertEquals('sendCustomData', $reportData['customData']['testCustomData']);

    }
    public function testClientAttachments(){
        $this->client->attachments = $this->getAttachments('testClientAttachmnet', 'test/client', 'client');
        $this->client->set_Attachments_Callback(array($this,'callback_Attachments'));
        $reportData = $this->client->getReport(null, null)->CollectData();
        $this->assertEquals('testClientAttachmnet', $reportData['attachments'][0]['name']);
        $this->assertEquals('test/client', $reportData['attachments'][0]['mimeType']);
        $this->assertEquals(base64_encode(gzencode('client', 9)), $reportData['attachments'][0]['content']);
    }
    public function testCallBackAttachments(){
        $this->client->set_Attachments_Callback(array($this,'callback_Attachments'));
        $reportData = $this->client->getReport(null, null)->CollectData();
        $this->assertEquals('testCallbackAttachment', $reportData['attachments'][0]['name']);
        $this->assertEquals('test/callback', $reportData['attachments'][0]['mimeType']);
        $this->assertEquals(base64_encode(gzencode('callback', 9)), $reportData['attachments'][0]['content']);
    }
    public function testSendAttachments(){
        $this->client->attachments = $this->getAttachments('testClientAttachmnet', 'test/client', 'client');
        $this->client->set_Attachments_Callback(array($this,'callback_Attachments'));
        $reportData = $this->client->getReport(null, $this->getAttachments('testSendAttachmnet', 'test/send', 'send'))->CollectData();
        $this->assertEquals('testSendAttachmnet', $reportData['attachments'][0]['name']);
        $this->assertEquals('test/send', $reportData['attachments'][0]['mimeType']);
        $this->assertEquals(base64_encode(gzencode('send', 9)), $reportData['attachments'][0]['content']);
    }
    function callback_Custom_Data(){
        return array('testCustomData' => 'callbackCustomData');
    }
    function callback_Attachments(){
        return $this->getAttachments('testCallbackAttachment', 'test/callback', 'callback');
    }
    function getAttachments($name, $mimeType, $content){
        $attachment = new Attachment();
        $attachment->name = $name;
        $attachment->mimeType = $mimeType;
        $attachment->content = $content;
        return array($attachment);
    }
}
?>