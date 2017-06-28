<?php
class ReportSender{
	const URI = 'http://logify.devexpress.com/api/report/newreport';
    public $API_key;

    function send( $data ) {
        $json = json_encode( $data );
        $header = $this->generate_header(strlen($json));
        $request = curl_init();
        curl_setopt_array( $request, [
            CURLOPT_URL => self::URI,
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
    function generate_header( $content_length ) {
        $header = array(
            'Authorization: amx '. $this->API_key,
            'Content-Type: application/json',
            'Content-Length: '.$content_length,
        );
        return $header;
    }
}
?>

