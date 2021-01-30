<?php

namespace cartthrob\omnipay\paytrace\Message\Check;

use cartthrob\omnipay\paytrace\Exception\InvalidCheckException;

/** @psalm-suppress PropertyNotSetInConstructor */
class CreateCardRequest extends AuthorizeRequest
{
    protected $type = 'CreateCustomer';
    protected $responseClass = 'cartthrob\omnipay\paytrace\Message\CreditCard\CreateCardResponse';

    /**
     * @inheritdoc
     * @throws InvalidCheckException
     */
    public function getData()
    {
        $this->validate('check');
        $check = $this->getCheck();
        if (!$check) {
            throw new InvalidCheckException('Check is null');
        }
        $check->validate();
        $data = $this->getBaseData();
        $data['DDA'] = $check->getBankAccount();
        $data['TR'] = $check->getRoutingNumber();
        $data['CUSTID'] = $this->getCardReference();
        $data['METHOD'] = $this->type;
        unset($data['TRANXTYPE']);
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        return array_merge($data, $this->getBillingData());
    }
}
