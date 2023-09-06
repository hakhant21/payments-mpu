<?php

namespace Hak\MyanmarPaymentUnion\Responses;

class TokenResponse
{
    public function __construct(
        public string $status,
        public string $message,
        public string $url,
        public string $token
    )
    {
        $this->status = $status;
        $this->message = $message;
        $this->url = $url;
        $this->token = $token;
    }
}

