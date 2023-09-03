<?php

use Hak\MyanmarPaymentUnion\PaymentGateway;

it('can initialize a new payment gateway', function(){
    $gateway = new PaymentGateway('test', 'secret_key', 'true');

    expect($gateway)->toBeInstanceOf(PaymentGateway::class);
});


it('can get payment token, payment url with token, status and message', function(){
    $gateway = new PaymentGateway('JT02', '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9');

    $token = $gateway->create([
        'currencyCode' => 'MMK',
        'amount' => 10000,
        'invoiceNo' => time(),
        'description' => 'test payment description'
    ]);

    expect($token)->toBeArray();
});

