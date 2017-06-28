<?php
class ReportSender{
    function send( $data ) {
		include('/config.php');
		$configs = new LogifyAlert();
		$json = json_encode( $data );
		$header = $this->generate_header(strlen($json), $configs::apiKey);
		$request = curl_init();
		curl_setopt_array( $request, [
		    CURLOPT_URL => $configs::serviceUrl,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HTTPHEADER => $header,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $json,
		    CURLOPT_FOLLOWLOCATION => true
		]);

		try {
		    $response = curl_exec( $request );
		    curl_close( $request );
		} catch ( Exception $e ) {
		    return $e;
		}
		return $response;
    }
    function generate_header( $content_length, $apiKey ) {
        $header = array(
            'Authorization: amx '. $apiKey,
            'Content-Type: application/json',
            'Content-Length: '.$content_length,
        );
        return $header;
    }
}
?>

