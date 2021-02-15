<?php

namespace Omnipay\Paytrace\Message\Token;

use Omnipay\Paytrace\Message\AbstractResponse;

class ClientTokenResponse extends AbstractResponse
{
    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return true;
    }

    public function getClientKey()
    {
        return $this->data['clientKey'] ?? '';
    }
}
