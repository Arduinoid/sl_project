<?php

namespace Models;
/**
 * This model will help provide an abstraction around Spotify data
 * spotify:artist:6xgUHoQfcHv3MuB9I9z6RO
 */
class MusicProvider
{
    private $http;
    private $bgc = '6xgUHoQfcHv3MuB9I9z6RO';
    private $credentials;
    private $token_url;

    public function __construct($http, $config)
    {
        $this->http = $http;
        $this->token_url = $config->configData->spotify_token_url;
        $this->credentials = base64_encode("{$config->configData->spotify_client}:{$config->configData->spotify_secret}");
        $this->http->setHeader('Authorization', "Basic {$this->credentials}");
    }

    public function getAlbums($resourceId)
    {
        return $this->http->get("https://api.spotify.com/v1/artists/{$resourceId}/albums");
    }

    public function getToken()
    {
        return $this->http->post($this->token_url, http_build_query(['grant_type' => 'client_credentials']));
    }
}
