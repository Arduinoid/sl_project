<?php

class Http
{
    public function request($method, $url, $secret, $payload) {
        $cnt = curl_init();
        curl_setopt_array($cnt, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$secret}"
            ]
        ]);
        $response = curl_exec($cnt);
        $info = curl_getinfo($cnt);

        if ($response === false) {
            return curl_error($cnt);
        }
        else {
            return $response;
        }
    }
}