<?php

namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
/** @psalm-suppress PropertyNotSetInConstructor */
class AuthorizeRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Authorization';
    /** @var string */
    protected $responseClass = 'cartthrob\omnipay\paytrace\Message\CreditCard\AuthorizeResponse';

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('amount');
        $data = $this->getBaseData();
        if ($this->getCardReference()) {
            $data['CUSTID'] = $this->getCardReference();
        } else {
            $data = array_merge($data, $this->getCardData());
        }
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        return array_merge($data, $this->getBillingData());
    }
}
