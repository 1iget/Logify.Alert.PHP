<?php
class ReportSender{
    public $API_key;
    function send( $url, $data ) {
        $curl = curl_init($url);
        $json = json_encode( $data );
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
            $info = curl_getinfo( $request );
            curl_close( $request );
        } catch ( Exception $e ) {
            return $e;
        }
        echo $json;
        return $response;
    }

    function generate_header( $content_length ) {
        $header = array(
        'Authorization' => "amx" .' '. $this->API_key,
        'Content-Type' => 'application/json',
        );
        if ( ! empty( $content_length ) || ! is_null( $content_length ) ) {
            $header['Content-Length'] = $content_length;
        }        
        return $header;
    }

}
?>

