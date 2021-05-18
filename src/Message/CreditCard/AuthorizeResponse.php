<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class AuthorizeResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['APPCODE']) && !empty($this->data['APPCODE'])
        && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }
}
