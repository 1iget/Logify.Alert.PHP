<?php
namespace DevExpress\Logify\Core;

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
		$header = $this->generate_header( strlen($json) );
        $result = true;
        for ($i = 1; $i <= 3; $i++) {
            $result = $this->send_core($json, $header);
            if($result === true){
                break;
            }
        }
        return $result;
    }
    private function send_core($json, $header){
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
}
?>

