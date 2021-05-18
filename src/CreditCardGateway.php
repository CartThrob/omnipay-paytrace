<?php

namespace Omnipay\Paytrace;

class CreditCardGateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PayTrace CreditCard';
    }
}
