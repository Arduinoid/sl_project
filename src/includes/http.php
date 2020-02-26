<?php

class Http
{
    private $headers = [];

    public function __construct() {}
    public function request($method, $url, $body='') {
        $cnt = curl_init();
        curl_setopt_array($cnt, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $body
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

    public function get($url)
    {
        return $this->request('GET', $url);
    }

    public function post($url, $body)
    {
        return $this->request('POST', $url, $body);
    }

    public function setHeader($name, $value)
    {
        $lower_key = strtolower($name);
        $this->headers[$lower_key] = "{$name}: {$value}";
    }
}