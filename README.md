# Logify Alert for PHP applications
A PHP client to report exceptions to [Logify Alert](https://logify.devexpress.com).

## Install 
install php client TO DO

## Quick Start
### Automatic error reporting
```php 5
    require_once('/LogifyAlertClient.php');
    
    $client = LogifyAlertClient::get_instance();
    $client->apiKey = 'SPECIFY_YOUR_API_KEY_HERE';
    $client->set_handlers();
```

### Manual error reporting
```php 5
    require_once('/LogifyAlertClient.php');
    
    try {
        $client = LogifyAlertClient::get_instance();
        $client->apiKey = 'SPECIFY_YOUR_API_KEY_HERE';
    }
    catch (Exception $e) {
        $client->send($e);
    }
```

## Configuration
You can set up the Logify Alert client using the **config.php** file as follows.
```php 5
<?php
    class LogifyAlert{
	const serviceUrl = 'http://logify.devexpress.com/api/report/newreport';
	const apiKey = 'SPECIFY_YOUR_API_KEY_HERE';
        const userId = 'php user';
        const appName = 'My Application';
        const appVersion = '1.0.2';

        public $globalVariablesPermissions = array(
            'get' => true,
            'post' => true,
            'cookie' => true,
            'files' => true,
            'enviroment' => true,
            'request' => true,
            'server' => true,
        );
    }
?>
```
Для использования этого конфига установите проперть клиента в соответсвующее значение.
```php 5
    $client->pathToConfigFile = '/config.php';
```

## API
### Properties
#### ApiKey
String. Specifies an [API Key](https://logify.devexpress.com/Documentation/CreateApp) used to register the applications within the Logify service.
```php
$client->apiKey = 'My Api Key';
```

#### AppName
String. Specifies the application name.
```php
$client->appName = 'My Application';
```
#### AppVersion
String. Specifies the application version.
```php
$client->appVersion = '1.0.2';
```

#### attachments
attachments. Specifies a collection of files attached to a report. The total attachments size must not be more than **3 Mb** per one crash report. The attachment name must be unique within one crash report.
```php
    require_once('/LogifyAlertClient.php');
    require_once('/Core/Attachment.php');

    $client = LogifyAlertClient::get_instance();
    $client->apiKey = 'SPECIFY_YOUR_API_KEY_HERE';
  
    $attachment = new Attachment();
    $attachment->name = "My attachment's unique name per one report";
    $attachment->content = file_get_contents('C:\Work\Image_to_attach.jpg');
  
    // We strongly recommend that you specify the attachment type.
    $attachment->mimeType = 'image/jpeg';
    
    $client->attachments = $attachments;
```

#### CustomData
array. Gets the collection of custom data sent with generated reports.
Use the **customData** property to attach additional information to the generated report. For instance, you can use this property to track additional metrics that are important in terms of your application: CPU usage, environment parameters, and so on.

```php
    $customData = array('CustomerName' => 'Mary');
    $client->customData = $customData;
```

#### get_instance
Returns the single instance of the LogifyAlert class.
```php
$client = LogifyAlertClient::get_instance();
```

#### userId
String. Specifies a unique user identifier that corresponds to the sent report.
```php
$client->userId = "user@myapp.com";
```

### Methods for automatic reporting
Logify Alert allows you to automatically listen to uncaught exceptions and deliver crash reports. For this purpose, use the methods below.

#### set_handlers()
Commands Logify Alert to start listening to uncaught exceptions and sends reports for all processed exceptions.
```php
$client->set_handlers();
```

#### restore_handlers()
Commands Logify Alert to stop listening to uncaught exceptions.
```php
$client->restore_handlers();
```


### Methods for manual reporting
Alternatively, Logify Alert allows you to catch required exceptions manually, generate reports based on caught exceptions and send these reports only. For this purpose, use the methods below.

#### send(Exception $ex)
Generates a crash report based on the caught exception and sends this report to the Logify Alert service.
```php
try {
    RunCode();
}
catch (Exception $ex) {
    $client->send($ex);
}
```

#### send(Exception $ex, $customData)
Sends the caught exception with specified custom data to the Logify Alert service.
```php
try {
    RunCode();
}
catch (Exception $ex) {
    $customdata = array('FailedOperation' => 'RunCode');
    $client->send($ex, $customdata);
}
```

#### send(Exception $ex, $customData, $attachments)
Sends the caught exception with specified custom data and attachments to the Logify Alert service.
```php
try {
  RunCode();
}
catch (Exception $ex) {
  $customdata = array('FailedOperation' => 'RunCode');
  
  require_once('/Core/Attachment.php');
  $attachment = new Attachment();
  $attachment->name = "My attachment's unique name per one report";
  $attachment->content = file_get_contents('C:\Work\Image_to_attach.jpg');
  // We strongly recommend that you specify the attachment type.
  $attachment->mimeType = 'image/jpeg';
  $attachments = array($attachment);

  $client->send($ex, $customdata, $attachments);
}
```

## Custom Clients
If the described client is not suitable for you, you can create a custom one. For more information, refer to the [Custom Clients](https://github.com/DevExpress/Logify.Alert.Clients/blob/develop/CustomClients.md) document.



## Properties

| Name | Type |
|------|------|
| $apiKey | string |
| $serviceUrl | string |
| $attachments | array |
| $customData | array |
| $userId | string |
| $globalVariablesPermissions | array |
| $pathToConfigFile | string |
| $appName | string |
| $appVersion | string |
    
 ## Functions

| Name | Parameters |
|----- | ---------- |
| send | Exception $exception[, $customData[, $attachments]] |	
| set_handlers ||
| get_instance ||
