<?php

use Hak\MyanmarPaymentUnion\PaymentGateway;

it('can initialize a new payment gateway', function(){
    $gateway = new PaymentGateway('JT01', 'ECC4E54DBA738857B84A7EBC6B5DC7187B8DA68750E88AB53AAA41F548D6F2D9', true);

    expect($gateway)->toBeInstanceOf(PaymentGateway::class);
});


it('can get payment token, payment url with token, status and message', function(){
    $gateway = new PaymentGateway('JT01', 'ECC4E54DBA738857B84A7EBC6B5DC7187B8DA68750E88AB53AAA41F548D6F2D9', true);

    $token = $gateway->create([
        'currencyCode' => 'SGD',
        'amount' => 1000,
        'invoiceNo' => random_int(11111111111, 999999999999),
        'description' => 'test payment description'
    ]);

    expect($token)->toBeArray();
});

it('can get payment inquiry', function(){
    $gateway = new PaymentGateway('JT02', '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9', true);

    $inquiry = $gateway->inquiry([
        'invoiceNo' => 660615404950
    ]);

    expect($inquiry)->toBeArray();
}); 

