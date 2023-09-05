<?php

namespace Hak\MyanmarPaymentUnion\Methods;

use Hak\MyanmarPaymentUnion\Traits\HasClient;
use Hak\MyanmarPaymentUnion\Traits\HasEncryption;
use Hak\MyanmarPaymentUnion\Contracts\PaymentMethod;
use Hak\MyanmarPaymentUnion\Responses\InquiryResponse;

class PaymentInquiry implements PaymentMethod
{
    use HasClient;
    use HasEncryption;
    
    protected array $parameters;
    
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function handle(string $secretKey): InquiryResponse
    {
        $encryptedData = $this->encrypt($this->parameters, $secretKey);

        $url = $this->getUrl();

        $response = $this->send($url, $encryptedData);

        if(!array_key_exists('payload', $response)){
            return new InquiryResponse($response);
        }

        $decryptedData = $this->decrypt($response['payload'], $secretKey);

        $payload = get_object_vars($decryptedData);

        return new InquiryResponse($payload);
    }

    private function getUrl(): string
    {
        if($this->parameters['sandboxMode'] == 'true') {
            return 'https://sandbox-pgw.2c2p.com/payment/4.1/paymentInquiry';
        } else {
            return 'https://pgw.2c2p.com/payment/4.1/paymentInquiry';
        }
    }
}