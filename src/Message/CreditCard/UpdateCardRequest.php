<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class UpdateCardRequest extends CreateCardRequest
{
    /** @var string */
    protected $type = 'UpdateCustomer';
}
