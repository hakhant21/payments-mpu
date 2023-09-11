# 2C2P Myanmar One Stop Payment Service Integration Package


## [![Testing](https://github.com/hakhant21/payments-mpu/actions/workflows/main.yml/badge.svg?branch=master&event=push)](https://github.com/hakhant21/payments-mpu/actions/workflows/main.yml)

## Installation
```bash

composer require hak/payments-mpu

```
### Usage 

```php
use Hak\Payments\PaymentGateway;

public function store(Request $request)
{
    // Request for paymentToken and Redirect Url
    $gateway = new PaymentGateway(
        'JT02',
        '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9',
        true
    );

    $payment = $gateway->create([
        'currencyCode' => 'MMK',
        'amount' => 1000,
        'invoiceNo' => random_int(11111111, 99999999),
        'description' => 'test payment description',
        'frontendReturnUrl' => 'https://example.com/frontend-return-url'
    ]);

    // that will return an instance of TokenResponse

    // Redirect Url
    $redirect_url = $payment->url;
    // status
    $status = $payment->status;
    // message
    $message = $payment->message;
    // Payment token
    $token = $payment->token;
}
```

```php

public function update(Request $request)
{
    $inquiry = $gateway->inquiry([
        'invoiceNo' => '000024252314'
    ]);

    // that will return array of payment inquiry details
    return $inquiry->getInquiry();
}

```

#### You can get config variables from developer.2c2p.com 
  * MERCHANT_ID // JT02 
  * SECRET_KEY // SHA256 key
  * frontendReturnUrl // https://example.com/fronend-result-url
  * backendReturnUrl // https://example.com/backend-result-url

