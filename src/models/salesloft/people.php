<?php

namespace Models\SalesLoft;

class People
{
    private $http;
    private $endpoint = 'https://api.salesloft.com/v2/people.json';
    private $secret;

    public function __construct($http, $config)
    {
        $this->http = $http;
        $this->secret = $config->configData->api_secret;
    }

    public function getAll()
    {
        $response = $this->http->request('GET', $this->endpoint, $this->secret, []);
        return json_decode($response)->data;
    }

    public function frequency()
    {
        $response = $this->http->request('GET', $this->endpoint, $this->secret, []);
        $people = json_decode($response)->data;
        $histogram = [];
        foreach($people as $person) {
            $letters = $this->filterSpecialCharacters(str_split($person->email_address));
            foreach($letters as $letter) {
                if (!isset($histogram[$letter])) {
                    $histogram[$letter] = 1;
                }
                else {
                    $histogram[$letter]++;
                }
            }
        }
        $result = [];
        arsort($histogram);
        foreach($histogram as $letter => $count) {
            $result[] = [$letter => $count];
        }
        return $result;
    }

    private function filterSpecialCharacters($array)
    {
        return array_filter($array, function($item) {
            return preg_match('#[A-Za-z]#', $item) == 1;
        });
    }
}