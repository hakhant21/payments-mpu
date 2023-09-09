<?php

namespace Hak\MyanmarPaymentUnion\Traits;

trait HasParameter
{
    public function getAmount(int $amount)
    {
        return str_pad((int)$amount, 12, '0', STR_PAD_LEFT);
    }

    public function getInvoice(int $invoiceNo)
    {
        return str_pad((int)$invoiceNo, 12, '0', STR_PAD_LEFT);
    }
}