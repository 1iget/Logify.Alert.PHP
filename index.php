<?php
use DevExpress\Logify\LogifyAlertClient;
use DevExpress\Logify\Core\Attachment;

if(array_key_exists ( 'throwButton' , $_POST )){

    require_once('C:/LogifyAlertPHP/Logify/LoadHelper.php');
    spl_autoload_register(array("DevExpress\LoadHelper", "LoadModule"));

    $client = LogifyAlertClient::get_instance();
    $client->pathToConfigFile = 'C:/LogifyAlertPHP/config.php';
    $customData = array('custom1' => 'data1', 'custom2' => 'data2');

    $attachment = new Attachment();
    $attachment->name = 'testPicture';
    $attachment->mimeType = 'image/jpeg';
    $content = file_get_contents('C:\LogifyAlertPHP\at.jpg');
    $attachment->content = $content;
    $attachments = array($attachment);
    $client->attachments = $attachments;
    $client->customData = $customData;
    $client->set_handlers();
    throwMyEx();
}
function throwMyEx(){

    strpos(); //throw error
    throw new Exception('test PHP Exception');
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
