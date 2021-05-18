<?php

namespace Omnipay\Paytrace\Message\Token;

use Omnipay\Paytrace\Message\AbstractResponse;

class TokenResponse extends AbstractResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return true;
    }
}
