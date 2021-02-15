<?php

namespace Omnipay\Paytrace\Message\CreditCard;

use Omnipay\Paytrace\Message\AbstractRequest;

class PurchaseRequest extends AuthorizeRequest
{
    /** @var string */
    protected $type = 'Authorization';

    /** @var string */
    protected $responseClass = 'Omnipay\Paytrace\Message\CreditCard\PurchaseResponse';

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . $this->getVersion() . '/transactions/sale/pt_protect';
    }

    /**
     * @return array|mixed|void
     */
    public function getData()
    {
        return json_encode([
            'amount' => $this->getParameter('amount'),
            'hpf_token' => $this->getParameter('hpf_token'),
            'enc_key' => $this->getParameter('enc_key'),
            'integrator_id' => $this->getParameter('integrator_id'),
            'invoice_id' => $this->getParameter('invoice_id')
        ]);
    }
}