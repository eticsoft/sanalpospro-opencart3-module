<?php

namespace Eticsoft\Paythor\Sanalpospro;

class ApiClient
{
    public $baseUrl = 'https://api.paythor.com';
    public $publicKey = '';
    public $secretKey = '';
    private $hash = '';
    private $hash_time = '';
    private $hash_rand = '';
    private $headers = [];
    private ?ApiResponse $apiresponse;

    public function __construct()
    {
        $settings = [
            'paythor_public_key' => EticConfig::get('public_key') ?? '',
            'paythor_secret_key' => EticConfig::get('secret_key') ?? '',
        ];
        $this->publicKey = $settings['paythor_public_key'] ?? '';
        $this->secretKey = $settings['paythor_secret_key'] ?? '';
    }

    public function setHash($publicKey, $secretKey): self
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->hash_time = microtime(true);
        $this->hash_rand = rand(1000000, 9999999);
        $this->hash = hash('sha256', $this->publicKey . $this->secretKey . $this->hash_time . $this->hash_rand);
        return $this;
    }

    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    public function setHeaders(): self
    {
        $auth_header = 'ApiKeys '
            . $this->publicKey . ':'
            . $this->hash;
        $this->addHeader('Content-Type: application/json');
        $this->addHeader('Authorization: ' . $auth_header);
        $this->addHeader('X-Timestamp: ' . $this->hash_time);
        $this->addHeader('X-Nonce: ' . $this->hash_rand);
        return $this;
    }

    public function get($url, $params = [])
    {
        return $this->call($url, 'GET', $params);
    }

    public function post($url, $params = [])
    {
        return $this->call($url, 'POST', $params);
    }

    public function call($url, $method = 'GET', $params = [])
    {
        $this->setHash($this->publicKey, $this->secretKey);
        $this->setHeaders();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $result = [
            'status' => $statusCode,
            'body' => $result
        ];

        $this->apiresponse = new ApiResponse($result);
        if (!$this->apiresponse->validate()) {
            return $this->apiresponse->getError();
        }
        return $this->apiresponse->response;
    }

    public static function getInstanse()
    {
        return new self();
    }
}
