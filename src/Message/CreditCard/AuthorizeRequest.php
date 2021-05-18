<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class AuthorizeRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Authorization';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse';

    public function getData()
    {
    }
}
