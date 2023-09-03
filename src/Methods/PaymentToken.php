<?php

namespace Hak\MyanmarPaymentUnion\Methods;

use Hak\MyanmarPaymentUnion\Traits\HasClient;
use Hak\MyanmarPaymentUnion\Traits\HasEncryption;
use Hak\MyanmarPaymentUnion\Contracts\PaymentMethod;

class PaymentToken implements PaymentMethod
{
    use HasClient;
    use HasEncryption;

    protected array $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function handle(): array
    {
        $encryptedData = $this->encrypt($this->parameters, $this->parameters['secretKey']);

        $url = $this->getUrl();

        $response = $this->send($url, $encryptedData);

        if(!$response['payload']){
            return $response;
        }

        $decryptedData = $this->decrypt($response['payload'], $this->parameters['secretKey']);

        $payload = get_object_vars($decryptedData);

        return [
            'status' => $payload['respCode'],
            'message' => $payload['respDesc'],
            'payment_url' => $payload['webPaymentUrl'],
            'token' => $payload['paymentToken'],
        ];
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
