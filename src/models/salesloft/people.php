<?php

namespace Models\SalesLoft;

class People
{
    private $http;
    private $endpoint = 'https://api.salesloft.com/v2/people.json';
    private $secret;

    public function __construct($http, $config, &$session)
    {
        $this->http = $http;
        $this->secret = $config->configData->api_secret;
        $this->peopleData = &$session['cache'];
    }

    public function getAll()
    {
        $this->peopleData = json_decode($this->http->request('GET', "{$this->endpoint}?per_page=100", $this->secret, []))->data;
        return $this->peopleData;
    }

    public function frequency()
    {
        $histogram = [];
        foreach($this->peopleData as $person) {
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

    public function getPossibleDuplicates()
    {
        $result = [];
        foreach($this->peopleData as $outerIndex => $person) {
            // break up the email into two parts
            $partsA = explode('@', $person->email_address);
            $aliasA = $partsA[0];
            $domainA = $partsA[1];
            // turn the string into an array to diff between
            $emailToCompare = str_split($aliasA);
            foreach($this->peopleData as $innerIndex => $other) {
                // break up the email into two parts
                $partsB = explode('@', $other->email_address);
                $aliasB = $partsB[0];
                $domainB = $partsB[1];
                
                // if we are on the same persons email or the domains don't match, move on to the next email
                if ($outerIndex === $innerIndex || $domainA !== $domainB) continue;
                
                // turn the string into an array to diff between
                $toBeCompared = str_split($aliasB);

                // start getting our length and diff counts for comparison
                $diff = array_diff($emailToCompare, $toBeCompared);
                $lengthDiff = abs(count($emailToCompare) - count($toBeCompared));
                $diffCount = count($diff);

                // if the counts are under the threshold then add the email to the list of possible duplicates
                if ($diffCount <= 4 && $lengthDiff <= 4) {
                    $result[$other->id] = $other->email_address;
                }
            }
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