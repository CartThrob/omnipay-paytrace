<?php

namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class CaptureRequest extends AbstractRequest
{
    protected $type = 'Capture';
    protected $responseClass = 'cartthrob\omnipay\paytrace\Message\CreditCard\CaptureResponse';

    public function getData()
    {
        $this->validate('transactionReference');
        $data = $this->getBaseData();
        $data['TRANXID'] = $this->getTransactionReference();
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        return $data;
    }
}
