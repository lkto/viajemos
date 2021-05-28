<?php

namespace App\Services;

class Location
{
    private $url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
    private $customerKey = 'dj0yJmk9YXd6OENPSFJaN0ZCJmQ9WVdrOVlVVTNOMlpOVTFJbWNHbzlNQT09JnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTdh';
    private $appId = 'aE77fMSR';
    private $consumerSecret = 'bbe8b19cd02bfd407d6a3258f2bc3a73d17dc213';
    /**
     * @var ApiClient
     */
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function get(string $codeCity)
    {
        $query = [
            'location' => $codeCity,
            'format' => 'json',
        ];
        $oauth = $this->apiClient->Authenticate($this->customerKey);
        $baseInfo = $this->apiClient->buildBaseString($this->url, 'GET', array_merge($query, $oauth));
        $compositeKey = rawurlencode($this->consumerSecret) . '&';
        $oauth_signature = base64_encode(hash_hmac('sha1', $baseInfo, $compositeKey, true));
        $oauth['oauth_signature'] = $oauth_signature;
        $header = [
            $this->apiClient->buildAuthorizationHeader($oauth),
            'X-Yahoo-App-Id: ' . $this->appId
        ];

        $options = [
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $this->url . '?' . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}