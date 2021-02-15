<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class CaptureRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Capture';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\CaptureResponse';

    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
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
