<?php

namespace Hak\MyanmarPaymentUnion\Responses;

class InquiryResponse 
{
      protected array $parameters;

      public function __construct(array $parameters = [])
      {
          $this->parameters = $parameters;
      }

      public function all()
      {
          return $this->parameters;
      }

      public function get($key)
      {
          return $this->parameters[$key];
      }
}