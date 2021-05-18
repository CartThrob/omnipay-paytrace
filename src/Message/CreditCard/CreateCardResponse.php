<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class CreateCardResponse extends AuthorizeResponse
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['CUSTOMERID']) && !empty($this->data['CUSTOMERID'])
        && (!isset($this->data['ERROR']) || empty($this->data['ERROR']));
    }

    /**
     * @return string|null
     */
    public function getCardReference()
    {
        return isset($this->data['CUSTOMERID']) ? $this->data['CUSTOMERID'] : null;
    }
}
