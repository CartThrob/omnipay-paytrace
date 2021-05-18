<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class CreateCardRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'CreateCustomer';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\CreateCardResponse';

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('card');
        $data = $this->getBaseData();
        $data = array_merge($data, $this->getCardData());
        $data['CUSTID'] = $this->getCardReference();
        $data['METHOD'] = $this->type;
        unset($data['TRANXTYPE']);
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }

        return array_merge($data, $this->getBillingData());
    }
}
