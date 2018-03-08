<?php

namespace App\Helpers;

class MailChimp {

	private $guzzleClient;
	private $apiKey;
	private $headers;
	private $url;

	public function __construct($apiKey) {

		$this->apiKey = $apiKey;

		// check if key is legit before proceeding
		if (!is_string($apiKey)) {
			throw new \Exception("API key must be a string");
		}
		if (strpos($apiKey, '-') === false) {
			throw new \Exception("API key $apiKey is invalid");
		}
		list($key, $dataCenter) = explode('-', $apiKey);

        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('user:' . $apiKey),
        ];

		$this->url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/';
		$this->guzzleClient = new \GuzzleHttp\Client();

	}

	/**
	 * Make request
	 *
	 * @param $method
	 * @param string $uri
	 * @param array $data
     * @param string $resourceID
	 * @return mixed
	 */
	public function request($method, $uri, array $data = []) {
	
        // make the request
		$request = new \GuzzleHttp\Psr7\Request($method, $this->url . $uri, $this->headers, json_encode($data));

        // return the response
		return $this->guzzleClient->send($request)->getBody()->getContents();
	}
}