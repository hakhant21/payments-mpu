# Myanmar Payment Union And 2C2P One Stop Payment Integration packages,

### Usage for Payment Token
```php

// sandbox mode default set to true,
// merchantID JT02, for Myanmar
// secretKey // get from [developer.2c2p.com](https://developer.2c2p.com/)

$gateway = new PaymentGateway($merchantID, $secretKey, $sandboxMode);

$gateway->create([
  'amount' => 10000,  // MMK
  'invoiceNo' => 1669955934,
  'description' => 'test payment description',
  'currencyCode' => 'MMK',  // eg. SGD, USD,
]);

// that will return an array

[
  'status' => '0000',
  'message' => 'Success',
  'payment_url' => 'https://sandbox-pgw-ui.2c2p.com/payment/4.1/#/token/kSAops9Zwhos8hSTSeLTUcCrwcnrndJUZanGJy3fBEsXCiYmynwxHvK5h7XPBadJqD0nG7v65t5N2jPVrnwX2jL4nu%2bKKSegjUjERKCyWPg%3d',
  'token' => 'kSAops9Zwhos8hSTSeLTUcCrwcnrndJUZanGJy3fBEsXCiYmynwxHvK5h7XPBadJqD0nG7v65t5N2jPVrnwX2jL4nu%2bKKSegjUjERKCyWPg%3d'
];

```

### Usage for Payment Inquiry
```php

$gateway->inquiry([
  'invoiceNo' => 1669955934,
]);


that will return an array
[
    "merchantID": "JT02",
    "invoiceNo": "1669955934",
    "amount": 10000,
    "currencyCode": "MMK",
    "transactionDateTime": "311220235959",
    "agentCode": "OCBC",
    "channelCode": "VI",
    "approvalCode": "717282",
    "referenceNo": "00010001",
    "cardNo": "411111XXXXXX1111",
    "cardToken": "",
    "issuerCountry": "MM",
    "eci": "02",
    "installmentPeriod": 0,
    "interestType": "M",
    "interestRate": 0.0,
    "installmentMerchantAbsorbRate ": 0.0,
    "recurringUniqueID": "",
    "fxAmount": 0.0,
    "fxRate": 0.0,
    "fxCurrencyCode": "MMK",
    "userDefined1": "",
    "userDefined2": "",
    "userDefined3": "",
    "userDefined4": "",
    "userDefined5": "",
    "acquirerReferenceNo": "",
    "acquirerMerchantId" : "",
    "cardType":"",
    "idempotencyID":"",
    "respCode": "0000",
    "respDesc": "Transaction is successful."
];

```
