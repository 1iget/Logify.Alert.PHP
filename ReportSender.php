<?php
class ReportSender{
    public $API_key;

    function send( $url, $data ) {
        $json = json_encode( $data );
        //echo $json;
        $header = $this->generate_header(strlen($json));
        $request = curl_init();
        curl_setopt_array( $request, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_FOLLOWLOCATION => true
        ]);
        
        try {
            $response = curl_exec( $request );
            curl_close( $request );
            $info = curl_getinfo( $response );
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

