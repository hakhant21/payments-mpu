<?php

namespace Hak\MyanmarPaymentUnion\Methods;

use Hak\MyanmarPaymentUnion\Traits\HasClient;
use Hak\MyanmarPaymentUnion\Traits\HasEncryption;
use Hak\MyanmarPaymentUnion\Contracts\PaymentMethod;
use Hak\MyanmarPaymentUnion\Responses\TokenResponse;

class PaymentToken implements PaymentMethod
{
    use HasClient;
    use HasEncryption;

    protected array $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function handle(string $secretKey): TokenResponse
    {
        $encryptedData = $this->encrypt($this->parameters, $secretKey);

        $url = $this->getUrl();

        $response = $this->send($url, $encryptedData);

        if(!array_key_exists('payload', $response)) {
            return new TokenResponse(
                $response['respCode'],
                $payload['respDesc']
            );
        } 

        $decryptedData = $this->decrypt($response['payload'], $secretKey);

        $payload = get_object_vars($decryptedData);

        return new TokenResponse(
            $payload['respCode'],
            $payload['respDesc'],
            $payload['webPaymentUrl'],
            $payload['paymentToken']
        );
    }

    private function getUrl(): string
    {
        if($this->parameters['sandboxMode'] == 'true') {
            return 'https://sandbox-pgw.2c2p.com/payment/4.1/paymentToken';
        } else {
            return 'https://pgw.2c2p.com/payment/4.1/paymentToken';
        }
    }
}
