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
    $token = $this->gateway->create([
        'currencyCode' => 'MMK',
        'amount' => $this->gateway->amount(1000),
        'invoiceNo' => $this->gateway->invoiceNo(random_int(11111111, 99999999)),
        'description' => 'test payment description'
    ]);

    expect($token)->toBeInstanceOf(TokenResponse::class);
    expect($token->getStatus())->toBeString();
    expect($token->getMessage())->toBeString();
    expect($token->getRedirectUrl())->toBeString();
    expect($token->getToken())->toBeString();
});

it('can get payment inquiry return array of payment inquiry details', function(){
    $inquiry = $this->gateway->inquiry([
        'invoiceNo' => '000024252314'
    ]);

    expect($inquiry->all())->toBeArray();
    expect($inquiry->get('respCode'))->toBeString('0000');
    expect($inquiry->get('tranRef'))->toBeString('7851993');
    expect($inquiry->get('merchantID'))->toBeString('JT02');
    expect($inquiry->get('currencyCode'))->toBeString('MMK');
    expect($inquiry->get('respDesc'))->toBeString('Success');
    expect($inquiry->get('invoiceNo'))->toBeString('000024252314');
}); 

