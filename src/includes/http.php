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
        $httpCode = curl_getinfo($cnt, CURLINFO_RESPONSE_CODE);
        $error = curl_error($cnt);
        curl_close($cnt);

        if ($response !== false && empty($error)) {
            return (object)[
                'body' => $response,
                'code' => $httpCode
            ];
        }
        else {
            throw new Exception("Could not make curl request to {$url} [ERROR] {$error}");
        }
    }
}