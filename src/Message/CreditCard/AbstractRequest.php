<?php

namespace unionco\omnipay\paytrace\Message\CreditCard;

abstract class AbstractRequest extends \unionco\omnipay\paytrace\Message\AbstractRequest
{
    protected $method = 'ProcessTranx';

    protected function getBillingSource()
    {
        return $this->getCard();
    }

    /**
     * @return array
     *
     * @psalm-return array{TERMS: string, UN: mixed, PSWD: mixed, METHOD: mixed, TRANXTYPE: mixed}
     */
    protected function getBaseData()
    {
        return [
            'TERMS' => 'Y',
            'UN' => $this->getUserName(),
            'PSWD' => $this->getPassword(),
            'METHOD' => $this->method,
            'TRANXTYPE' => $this->type,
        ];
    }

    /**
     * @return (false|string)[]
     *
     * @psalm-return array{CC: string, EXPYR: false|string, EXPMNTH: string, CSC: string}
     */
    protected function getCardData()
    {
        $this->validate('card');
        $this->getCard()->validate();
        $card = $this->getCard();
        $data = array();
        $data['CC'] = $card->getNumber();
        $data['EXPYR'] = substr("{$card->getExpiryYear()}", -2);
        $data['EXPMNTH'] = str_pad("{$card->getExpiryMonth()}", 2, '0', STR_PAD_LEFT);
        $data['CSC'] = $card->getCvv();
        return $data;
    }
}
