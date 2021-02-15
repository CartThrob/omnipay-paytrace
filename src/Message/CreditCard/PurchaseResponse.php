<?php

namespace Omnipay\Paytrace\Message\CreditCard;

use Omnipay\Paytrace\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data->success) && $this->data->success === true;
    }
}
