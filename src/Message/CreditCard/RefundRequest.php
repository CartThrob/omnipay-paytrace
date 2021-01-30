<?php

namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class RefundRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Refund';
    /** @var string */
    protected $responseClass = 'cartthrob\omnipay\paytrace\Message\CreditCard\CaptureResponse';

    /** @inheritdoc */
    public function getData()
    {
        if ($this->getCard()) {
            $this->validate('amount', 'card');
            $this->getCard()->validate();
            $data = $this->getBaseData();
            $data['AMOUNT'] = $this->getAmount();
            $data = array_merge($data, $this->getCardData());
            if ($this->getTestMode()) {
                $data['TEST'] = 'Y';
            }
        } else {
            $this->validate('transactionReference');
            $data = $this->getBaseData();
            $data['TRANXID'] = $this->getTransactionReference();
            if ($this->getAmount()) {
                $data['AMOUNT'] = $this->getAmount();
            }
        }
        return $data;
    }
}
