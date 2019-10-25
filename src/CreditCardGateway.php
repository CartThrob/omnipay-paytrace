<?php

namespace unionco\omnipay\paytrace;

class CreditCardGateway extends AbstractGateway
{
    const GATEWAY_TYPE = 'CreditCard';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'PayTrace CreditCard';
    }
}
