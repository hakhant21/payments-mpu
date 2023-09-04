# Myanmar Payment Union And 2C2P One Stop Payment Integration packages,

### Usage for Payment Token
```php

// sandbox mode default set to true,
// merchantID JT02, for Myanmar
// secretKey // get from [developer.2c2p.com](https://developer.2c2p.com/)

$gateway = new PaymentGateway($merchantID, $secretKey, $sandboxMode);

$gateway->create([
  'amount' => $gateway->amount(10000),  // MMK format str_pad(10000, 12, '0', STR_PAD_LEFT)
  'invoiceNo' => $gateway->invoiceNo(time()), // format str_pad(time(), 12, '0', STR_PAD_LEFT)
  'description' => 'test payment description', 
  'currencyCode' => 'MMK',  // eg. SGD, USD,
]);

// that will return an array
[ 
  "status" => "0000"
  "message" => "Success"
  "payment_url" => "https://sandbox-pgw-ui.2c2p.com/payment/4.1/#/token/kSAops9Zwhos8hSTSeLTUQ5vV3tq8enak%2fvxxsiwuWvyZfUSa6qZHT1sQYYw8mgAKwffFizmYsl6jsxAKJVSa2A7TjgzNSxTTakmMvr%2bL0w%3d"
  "token" => "kSAops9Zwhos8hSTSeLTUQ5vV3tq8enak/vxxsiwuWvyZfUSa6qZHT1sQYYw8mgAKwffFizmYsl6jsxAKJVSa2A7TjgzNSxTTakmMvr+L0w="
];

```

### Usage for Payment Inquiry
```php

$gateway->inquiry([
  'invoiceNo' => '000024252314',
]);


// that will return an array
 [ 
  "cardNo" => "411111XXXXXX1111"
  "cardToken" => ""
  "loyaltyPoints" => null
  "merchantID" => "JT02"
  "invoiceNo" => "000024252314"
  "amount" => 10000.0
  "monthlyPayment" => null
  "userDefined1" => ""
  "userDefined2" => ""
  "userDefined3" => ""
  "userDefined4" => ""
  "userDefined5" => ""
  "currencyCode" => "MMK"
  "recurringUniqueID" => ""
  "tranRef" => "7851993"
  "referenceNo" => "7145706"
  "approvalCode" => "209080"
  "eci" => "05"
  "transactionDateTime" => "20230904160623"
  "agentCode" => "KBANK"
  "channelCode" => "VI"
  "issuerCountry" => "US"
  "issuerBank" => "JPMORGAN CHASE BANK N.A."
  "installmentMerchantAbsorbRate" => null
  "cardType" => "CREDIT"
  "idempotencyID" => ""
  "paymentScheme" => "VI"
  "respCode" => "0000"
  "respDesc" => "Success"
];

```
