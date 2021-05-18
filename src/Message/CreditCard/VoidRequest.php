<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class VoidRequest extends CaptureRequest
{
    /** @var string */
    protected $type = 'Void';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\VoidResponse';

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . $this->getVersion() . '/transactions/void';
    }

    /** {@inheritdoc} */
    public function getData()
    {
        $data = $this->getBaseData();

        $data['transaction_id'] = $this->getTransactionReference();

        return json_encode($data);
    }
}
