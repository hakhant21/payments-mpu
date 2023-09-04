<?php

namespace Hak\MyanmarPaymentUnion\Contracts;

interface PaymentMethod
{
    public function handle(string $secretKey): array;
}