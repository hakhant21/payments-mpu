<?php

use Hak\MyanmarPaymentUnion\PaymentGateway;
use Hak\MyanmarPaymentUnion\Responses\InquiryResponse;
use Hak\MyanmarPaymentUnion\Responses\TokenResponse;

beforeEach(function(){
    $this->gateway = new PaymentGateway(
        'JT02',
        '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9',
        true
    );
});

it('can initialize a new payment gateway', function(){
    expect($this->gateway)->toBeInstanceOf(PaymentGateway::class);
});

it('can get payment token, payment url with token, status and message', function(){
    $payment = $this->gateway->create([
        'currencyCode' => 'MMK',
        'amount' => 1000,
        'invoiceNo' => random_int(11111111, 99999999),
        'description' => 'test payment description',
    ]);

    expect($payment)->toBeInstanceOf(TokenResponse::class);
    expect($payment->status)->toBeString();
    expect($payment->message)->toBeString();
    expect($payment->url)->toBeString();
    expect($payment->token)->toBeString();
});

it('can get payment inquiry return array of payment inquiry details', function(){
    $inquiry = $this->gateway->inquiry([
        'invoiceNo' => '000024252314'
    ]);

    expect($inquiry->parameters)->toBeArray();
}); 

