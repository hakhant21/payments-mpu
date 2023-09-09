<?php

namespace Hak\MyanmarPaymentUnion;

use Hak\MyanmarPaymentUnion\Methods\PaymentToken;
use Hak\MyanmarPaymentUnion\Methods\PaymentInquiry;
use Hak\MyanmarPaymentUnion\Abstracts\AbstractGateway;
use Hak\MyanmarPaymentUnion\Traits\HasParameter;

class PaymentGateway
{
    use HasParameter;

    public function __construct(
        private string $merchantID = '',
        private string $secretKey = '',
        private bool $sandboxMode = true,
    )
    {
        $this->setMerchantID($merchantID);
        $this->setSecretKey($secretKey);
        $this->setSandboxMode($sandboxMode); 
    }

    public function create(array $parameters)
    {
        $parameters = array_merge([
            'merchantID' => $this->getMerchantID(),
            'sandboxMode' => $this->getSandboxMode(),
            'amount' => $this->getAmount($parameters['amount']),
            'invoiceNo' => $this->getInvoice($parameters['invoiceNo'])
        ], $parameters);

       $payload = new PaymentToken($parameters);

       return $payload->handle($this->getSecretKey());
    }

    public function inquiry(array $parameters)
    {
        $parameters = array_merge([
            'merchantID' => $this->getMerchantID(),
            'sandboxMode' => $this->getSandboxMode(),
        ], $parameters);

        $inquiry = new PaymentInquiry($parameters);

        return $inquiry->handle($this->getSecretKey());
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
