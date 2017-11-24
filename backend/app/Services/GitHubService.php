<?php

namespace App\Services;

use GuzzleHttp\Client;
use stdClass;

/**
 * Class GitHubService
 * @package App\Http\Services
 */
class GitHubService
{
    const ENDPOINT_ACCESS_TOKEN = 'https://github.com/login/oauth/access_token';
    const ENDPOINT_USER = 'https://api.github.com/user';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $headers = ['Accept' => 'application/json'];

    /**
     * @var Client
     */
    private $http;

    /**
     * GitHubService constructor.
     * @param Client $http
     * @param array $config
     */
    public function __construct(Client $http, array $config)
    {
        $this->config = $config;
        $this->http = $http;
    }

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @param string $code
     * @return string
     */
    public function obtainAccessToken($code)
    {
        $params = [
            'client_id' => $this->config['clientId'],
            'client_secret' => $this->config['clientSecret'],
            'code' => $code,
        ];

        $response = $this->http->get(
            self::ENDPOINT_ACCESS_TOKEN,
            ['headers' => $this->headers, 'query' => $params]
        );

        $json = json_decode($response->getBody(), true);

        return $json['access_token'];
    }

    /**
     * @return stdClass
     */
    public function getUser()
    {
        $response = $this->http->get(
            self::ENDPOINT_USER,
            ['headers' => array_merge($this->headers, $this->getAccessTokenHeader())]
        );

        return json_decode($response->getBody());
    }

    /**
     * @return array
     */
    protected function getAccessTokenHeader()
    {
        return ['Authorization' => 'Bearer ' . $this->accessToken];
    }
}
