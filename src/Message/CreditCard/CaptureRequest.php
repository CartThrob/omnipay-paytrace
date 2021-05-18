<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class CaptureRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Capture';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\CaptureResponse';

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . $this->getVersion() . '/transactions/authorization/capture';
    }

    /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference');
        $data = $this->getBaseData();

        $data['amount'] = $this->getAmount();
        $data['transaction_id'] = $this->getTransactionReference();

        return json_encode($data);
    }
}
