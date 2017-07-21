<?php
use DevExpress\Logify\LogifyAlertClient;
use DevExpress\Logify\Core\Attachment;

if(array_key_exists ( 'throwButton' , $_POST )){

    require_once('C:/LogifyAlertPHP/Logify/LoadHelper.php');
    spl_autoload_register(array("DevExpress\LoadHelper", "LoadModule"));

    $client = LogifyAlertClient::get_instance();
    $client->pathToConfigFile = 'C:/LogifyAlertPHP/config.php';
    //
    //$client->send_offline_reports();
    //
    $client->start_exceptions_handling();
    $client->set_can_report_exception_callback('can_report_exception');
    $client->set_before_report_exception_callback('before_report_exception');
    $client->set_after_report_exception_callback('after_report_exception');
    try{
        throwMyEx();
    }catch (Throwable $e){
        $client->send($e);
    }
}
function throwMyEx(){
    //count();
    //strpos(); //throw
    //strpos2(); //errors
    throw new \Exception('PHP Exception '.date_create('now')->format('Y-m-d H:i:s') );
}
function can_report_exception($exception){
    return true;
}
function before_report_exception(){
    $client = LogifyAlertClient::get_instance();
    $client->customData = get_CustomData();
    $client->attachments = get_Attachments();
}
function after_report_exception($response){
    if($response !== true){
        echo $response.'<br />';
    }
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
