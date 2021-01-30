<?php

namespace cartthrob\omnipay\paytrace\Message\Check;

use cartthrob\omnipay\paytrace\Exception\InvalidCheckException;


/** @psalm-suppress PropertyNotSetInConstructor */
class AuthorizeRequest extends AbstractRequest
{
    protected $method = 'ProcessCheck';
    protected $type = 'Hold';

    /**
     * @inheritdoc
     * @throws InvalidCheckException
     */
    public function getData()
    {
        $this->validate('amount', 'check');
        $check = $this->getCheck();
        if (!$check) {
            throw new InvalidCheckException('Check is null');
        }
        $check->validate();
        $data = $this->getBaseData();
        $data['DDA'] = $check->getBankAccount();
        $data['TR'] = $check->getRoutingNumber();
        $data['AMOUNT'] = $this->getAmount();
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        return array_merge($data, $this->getBillingData());
    }
}
