<?php

namespace Hak\MyanmarPaymentUnion;

use Hak\MyanmarPaymentUnion\Methods\PaymentInquiry;
use Hak\MyanmarPaymentUnion\Methods\PaymentToken;

class PaymentGateway 
{
    private $merchantID;
    private $secretKey;
    private $sandboxMode;

    public function __construct(string $merchantID = null, string $secretKey = null,$sandboxMode = true)
    {
        $this->setMerchantID($merchantID);
        $this->setSecretKey($secretKey);
        $this->setSandboxMode($sandboxMode); 
    }

    public function create(array $parameters)
    {
        $parameters = array_merge([
            'merchantID' => $this->getMerchantID(),
            'secretKey' => $this->getSecretKey(),
            'sandboxMode' => $this->getSandboxMode(),
        ], $parameters);

       $payload = new PaymentToken($parameters);

       return $payload->handle();
    }

    public function inquiry(array $parameters)
    {
        $parameters = array_merge([
            'merchantID' => $this->getMerchantID(),
            'secretKey' => $this->getSecretKey(),
            'sandboxMode' => $this->getSandboxMode(),
        ], $parameters);

        $inquiry = new PaymentInquiry($parameters);

        return $inquiry->handle();
    }

    public function getMerchantID()
    {
        return $this->merchantID;
    }

    public function setMerchantID(string $merchantID)
    {
        $this->merchantID = $merchantID;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function getSandboxMode()
    {
        return $this->sandboxMode;
    }

    public function setSandboxMode($sandboxMode)
    {
        $this->sandboxMode = $sandboxMode;
    }
}
