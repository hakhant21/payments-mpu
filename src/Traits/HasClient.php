<?php

namespace Hak\MyanmarPaymentUnion\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait HasClient 
{
    public function send(string $url, string $payload)
    {
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
        ]);

        try{
            $payload = json_encode(['payload' => $payload]);

            $response = $client->request('POST', $url, [
                'body' => $payload,
            ])->getBody()->getContents();

            return json_decode($response, true);

        }catch(GuzzleException $e) {
            return $e->getMessage();
        }
    }
}