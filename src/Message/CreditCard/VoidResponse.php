<?php

namespace Omnipay\Paytrace\Message\CreditCard;

use Omnipay\Paytrace\Message\AbstractResponse;

class VoidResponse extends AbstractResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return !isset($this->data['ERROR']) || empty($this->data['ERROR']);
    }
}
