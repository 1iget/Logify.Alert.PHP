<?php
class ReportSender{
	public $apiKey;
	public $serviceUrl;

	function __construct($apiKey, $serviceUrl){
		$this->apiKey = $apiKey;
		$this->serviceUrl = $serviceUrl;
	}

    function send( $data ) {
		$json = json_encode( $data );
		$header = $this->generate_header( strlen($json) );
		$request = curl_init();
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
		    curl_close( $request );
		}
        catch ( Exception $e ) {
		    return $e;
		}
		return $response;
    }
    function generate_header( $content_length ) {
        $header = array(
            'Authorization: amx '. $this->apiKey,
            'Content-Type: application/json',
            'Content-Length: '.$content_length,
        );
        return $header;
    }
}
?>

