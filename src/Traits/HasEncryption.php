<?php

namespace Hak\MyanmarPaymentUnion\Traits;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait HasEncryption
{
    public function encrypt(array $payload, $secretKey)
    {
        $validated = $this->validate($payload);

        if($validated == false) {
            return json_encode(['message' => 'Given payload is not valid']);
        }

        return JWT::encode($payload, $secretKey, 'HS256');
    }

    public function decrypt(string $payload, $secretKey)
    {
        return JWT::decode($payload, new Key($secretKey, 'HS256'));
    }

    protected function validate(array $parameters)
    {
        $defaults = $this->defaultParameters();

        $payload = array_diff_key($defaults, $parameters);

        if(!$payload) {
            return false;
        } else {
            return true;
        }
    }

    protected function defaultParameters()
    {
        return [
           'merchantID',
           'currencyCode',
           'amount',
           'invoiceNo',
           'description'
        ];
    }
}

