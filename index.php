<?php
use DevExpress\Logify\LogifyAlertClient;
use DevExpress\Logify\Core\Attachment;

if(array_key_exists ( 'throwButton' , $_POST )){

    require_once('C:/LogifyAlertPHP/Logify/LoadHelper.php');
    spl_autoload_register(array("DevExpress\LoadHelper", "LoadModule"));

    $client = LogifyAlertClient::get_instance();
    $client->pathToConfigFile = 'C:/LogifyAlertPHP/config.php';

    //$customData = array('custom1' => 'data1', 'custom2' => 'data2');
    //$attachment = new Attachment();
    //$attachment->name = 'testPicture';
    //$attachment->mimeType = 'image/jpeg';
    //$content = file_get_contents('C:\LogifyAlertPHP\at.jpg');
    //$attachment->content = $content;
    //$attachments = array($attachment);
    //$client->attachments = $attachments;
    //$client->customData = $customData;

    $client->start_exceptions_handling();
    $client->set_can_report_exception_callback('can_ReportException');
    $client->set_before_report_exception_callback('before_ReportException');
    $client->set_after_report_exception_callback('after_ReportException');
    throwMyEx();
}
function throwMyEx(){
    strpos(); //throw
    strpos2(); //errors
    throw new Exception('test PHP Exception');
}
function can_ReportException($exception){
    return true;
}
function before_ReportException(){
    $client = LogifyAlertClient::get_instance();
    $client->customData = get_CustomData();
    $client->attachments = get_Attachments();
}
function after_ReportException(){
    echo 'after<br />';
}
function get_CustomData(){
    return array('custom1' => 'data1', 'custom2' => 'data2');
}
function get_Attachments(){
    $attachment = new Attachment();
    $attachment->name = 'testPicture.jpg';
    $attachment->mimeType = 'image/jpeg';
    $content = file_get_contents('C:\LogifyAlertPHP\at.jpg');
    $attachment->content = $content;
    return array($attachment);
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
    <form enctype="multipart/form-data" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
        <input type="submit" class="button" name="throwButton" value="throw" />
    </form>
    </body>
</html>
