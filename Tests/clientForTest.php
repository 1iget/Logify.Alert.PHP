<?php
require_once(__DIR__.'/../LogifyAlertClient.php');

class LogifyAlertTestClient extends LogifyAlertClient {
    public function configureCall(){
        $this->configure();
    }
}
?>