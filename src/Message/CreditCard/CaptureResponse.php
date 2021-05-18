<?php

namespace Omnipay\Paytrace\Message\CreditCard;

use Omnipay\Paytrace\Message\AbstractResponse;

class CaptureResponse extends AbstractResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return empty($this->getMessage());
    }
}
