<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class AuthorizeRequest extends AbstractRequest
{
    /** @var string */
    protected $type = 'Authorization';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse';

    public function getData()
    {

    }
//    /**
//     * @inheritdoc
//     */
//    public function getData()
//    {
//        return $this->getBaseData();
//////        $this->validate('amount');
////        $data = $this->getBaseData();
////        if ($this->getCardReference()) {
////            $data['CUSTID'] = $this->getCardReference();
////        } else {
////            $data = array_merge($data, $this->getCardData());
////        }
////        if ($this->getTestMode()) {
////            $data['TEST'] = 'Y';
////        }
////        return array_merge($data, $this->getBillingData());
//    }
}
