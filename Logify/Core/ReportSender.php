<?php
namespace DevExpress\Logify\Core;
use DevExpress\Logify\LogifyAlertClient;

class ReportSender{
	public $apiKey;
	public $serviceUrl = 'http://logify.devexpress.com/api/report/newreport';

	function __construct($apiKey, $serviceUrl = null){
		$this->apiKey = $apiKey;
        if($serviceUrl != null){
            $this->serviceUrl = $serviceUrl;
        }
	}
    function send( $data ) {
        $json = json_encode( $data );
        $result = true;
        for ($i = 1; $i <= 3; $i++) {
            $result = $this->send_core($json);
            if($result === true){
                break;
            }
        }
        if($result !== true){
            $client = LogifyAlertClient::get_instance();
            if($client->offlineReportsEnabled === true && $client->offlineReportsCount !== null){
                $this->save_report($json, $client->offlineReportsDirectory, $client->offlineReportsCount);
            }
        }
        return $result;
    }
    function send_offline_reports() {
        $client = LogifyAlertClient::get_instance();
        $files = glob($client->offlineReportsDirectory.'lrp*.*');
        if(is_array($files)){
            foreach($files as $filename){
                $json = file_get_contents($filename);
                if($this->send_core($json) === true){
                    unlink($filename);
                }
            }
        }
    }

    private function send_core($json){
        $header = $this->generate_header( strlen($json) );
		$request = curl_init();
        $errorMessage = '';
		curl_setopt_array( $request, [
		    CURLOPT_URL => $this->serviceUrl,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HTTPHEADER => $header,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $json,
		    CURLOPT_FOLLOWLOCATION => true
		]);
		try {
		    $response = curl_exec( $request );
            if($response === false){
                $errorMessage = curl_error($request);
            }
		    curl_close( $request );
		}
        catch ( Exception $e ) {
		    return $e;
		}
        if(empty($errorMessage)){
            return true;
        }
        return $errorMessage;
    }
    private function generate_header( $content_length ) {
        $header = array(
            'Authorization: amx '. $this->apiKey,
            'Content-Type: application/json',
            'Content-Length: '.$content_length,
        );
        return $header;
    }
    private function save_report($json, $directory, $maxReportsCount){
        $files = glob($directory.'lrp*.*');
        if(is_array($files)){
            if(count($files) === $maxReportsCount){
                $filetodelete = $files[0];
                $youngtime = filemtime($filetodelete);
                foreach($files as $filename){
                    $oldtime = filemtime($filename);
                    if($youngtime > $oldtime){
                        $filetodelete = $filename;
                        $youngtime = $oldtime;
                    }
                }
                unlink($filetodelete);
            }
        }
        $filename = tempnam($directory, 'lrp');
        if($filename !== false){
            file_put_contents ( $filename , $json );
        }
    }
}
?>

