<?php

namespace unionco\omnipay\paytrace;

class CheckGateway extends AbstractGateway
{
    const GATEWAY_TYPE = 'Check';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'PayTrace Check';
    }
}
