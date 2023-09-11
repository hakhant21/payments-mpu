<?php

namespace Hak\MyanmarPaymentUnion\Responses;

class InquiryResponse 
{
      public array $parameters;

      public function __construct(array $parameters = [])
      {
          $this->parameters = $parameters;
      }

      public function getInquiry()
      {
          return $this->parameters;
      }
}