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


class Person
{
    public $fullName;
    public $email;
    public $title;

    public function __construct($person) {
        $this->fullName = $person->display_name;
        $this->email = $person->email_address;
        $this->title = $person->title;
    }
}


class People
{
    public $list = [];

    public function __construct($peopleList) {
        foreach($peopleList as $person) {
            $this->list[$person->id] = new Person($person);
        }
    }
}

$endpoint = 'https://api.salesloft.com/v2/people.json';
$secret = json_decode(file_get_contents('./config.json'))->api_secret;

$http = new Http();

try {
    $response = $http->request('GET', $endpoint, $secret, []);
    $pl = new People(json_decode($response)->data);
    file_put_contents('./persons.json',json_encode($pl->list));
    var_dump($pl);
}

catch (Exception $e) {
    error_log($e->getMessage());
    error_log(curl_error($cnt));
}