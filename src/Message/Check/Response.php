<?php

namespace cartthrob\omnipay\paytrace\Message\Check;

use cartthrob\omnipay\paytrace\Message\AbstractResponse;

class Response extends AbstractResponse
{
    const TRANSACTION_KEY = 'CHECKIDENTIFIER';

    public function isSuccessful()
    {
        return isset($this->data[static::TRANSACTION_KEY]) && !empty($this->data[static::TRANSACTION_KEY])
        && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }
}
