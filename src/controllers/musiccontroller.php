<?php

namespace Controllers;

use Controllers\ControllerBase;
use Models\MusicProvider;
use \stdClass;

class MusicController extends ControllerBase
{
    public function defaultAction()
    {
        $music = $this->getMusicProvider();
        $res = $music->getToken();
        // $res = $music->getAlbums('6xgUHoQfcHv3MuB9I9z6RO');

        var_dump($res);
        $context = new stdClass();
        $context->message = 'Spotify Music Project';
        $context->albums = [];
        $output = $this->loadView('spotify', $context);
        return $this->writeBody($output);
    }

    public function getMusicProvider()
    {
        // new up a music provider instance and return it
        try {
            $config = \Config::load(CONFIGPATH);
            $http = new \Http();
            return new MusicProvider($http, $config);
        }
        catch (\Exception $e) {
            return null;
        }
    }
}