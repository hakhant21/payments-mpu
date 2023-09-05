<?php

namespace Hak\MyanmarPaymentUnion\Responses;

class TokenResponse
{
    public function __construct(
        protected string $status,
        protected string $message,
        protected string $url,
        protected string $token
    )
    {
        $this->status = $status;
        $this->message = $message;
        $this->url = $url;
        $this->token = $token;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getRedirectUrl(): string
    {
        return $this->url;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}

