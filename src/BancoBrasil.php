<?php

namespace MGM;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class BancoBrasil
{
    private string $clientID;
    private string $clientSecret;
    private string $developerKey;
    private string $enviroment;
    private string $urlToken;
    private string $url;
    private Client $httpClient;

    public function __construct($clientID, $clientSecret, $developerKey, $enviroment = "sandbox")
    {
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->developerKey = $developerKey;
        $this->base64 = "{$this->clientID}:{$this->clientSecret}";
        $this->enviroment = $enviroment;

        if($enviroment == 'sandbox'){
            $this->urlToken = 'https://oauth.sandbox.bb.com.br/oauth/token';
            $this->url = 'https://api.sandbox.bb.com.br/';
        }else{
            $this->urlToken = 'https://oauth.bb.com.br/oauth/token';
            $this->url = 'https://api.bb.com.br/';
        }

        $this->httpClient = new Client([
            'base_uri' => $this->url,
        ]);

    }

    public function getTokenAcess()
    {
        $headers = [
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Basic ".base64_encode($this->clientID.':'.$this->clientSecret)
        ];

        $body = [
            'grant_type' => "client_credentials",
            'scope' => "cobrancas.boletos-info cobrancas.boletos-requisicao",
        ];

        try {
            $response = $this->httpClient->post(
                $this->urlToken,
                [
                    'headers' => $headers,
                    'form_params' => $body
                ]
            );
        }catch(\Exception $e){
            return $e->getMessage();
        }

        return json_decode($response->getBody()->getContents());
    }

    public function register(array $fields = null){

        $headers = [
            "Authorization"     => "Bearer " . $this->getTokenAcess()->access_token,
            "Content-Type"      => "application/json",
        ];

        $this->enviroment === "sandbox"  ? $headers["X-Developer-Application-Key"] = $this->developerKey : $headers["X-Application-Key"] = $this->developerKey;

        try {
            $response = $this->httpClient->post(
                "cobrancas/v2/boletos",
                [
                    "headers" => $headers,
                    "json" => $fields
                ]
            );

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }

    }

    public function alter($idBoleto, array $fields = null){

        $headers = [
            "Authorization"     => "Bearer " . $this->getTokenAcess()->access_token,
            "Content-Type"      => "application/json",
        ];

        $this->enviroment === "sandbox"  ? $headers["X-Developer-Application-Key"] = $this->developerKey : $headers["X-Application-Key"] = $this->developerKey;

        try {
            $response = $this->httpClient->patch(
                "cobrancas/v2/boletos/{$idBoleto}",
                [
                    "headers" => $headers,
                    "json" => $fields
                ]
            );

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    public function read($idBoleto, $convenio)
    {
        $headers = [
            "Authorization"     => "Bearer " . $this->getTokenAcess()->access_token,
            "Content-Type"      => "application/json",
        ];

        $this->enviroment === "sandbox"  ? $headers["X-Developer-Application-Key"] = $this->developerKey : $headers["X-Application-Key"] = $this->developerKey;

        try {
            $response = $this->httpClient->get(
                "cobrancas/v2/boletos/{$idBoleto}?numeroConvenio={$convenio}",
                [
                    "headers" => $headers
                ]
            );

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }

    public function baixar($idBoleto, array $fields = null){

        $headers = [
            "Authorization"     => "Bearer " . $this->getTokenAcess()->access_token,
            "Content-Type"      => "application/json",
        ];

        $this->enviroment === "sandbox"  ? $headers["X-Developer-Application-Key"] = $this->developerKey : $headers["X-Application-Key"] = $this->developerKey;

        try {
            $response = $this->httpClient->post(
                "cobrancas/v2/boletos/{$idBoleto}/baixar",
                [
                    "headers" => $headers,
                    "json" => $fields
                ]
            );

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }

}