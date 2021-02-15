<?php

namespace Omnipay\Paytrace\Message;

use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var string $method */
    protected $method;

    /** @var string $type */
    protected $type;

    /** @var string $responseClass */
    protected $responseClass;

    /**
     * @param mixed $data
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $headers = [
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getToken(),
        ];

        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            $headers,
            $data
        );

        $responseClass = $this->responseClass;

        $response = new $responseClass($this, json_decode((string) $httpResponse->getBody()->getContents()));
        $this->response = $response;

        return $response;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->getParameter('username');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setUserName($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return string
     */
    public function getHpfToken()
    {
        return $this->getParameter('hpf_token');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setHpfToken($value)
    {
        return $this->setParameter('hpf_token', $value);
    }

    /**
     * @return string
     */
    public function getEncKey()
    {
        return $this->getParameter('enc_key');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setEncKey($value)
    {
        return $this->setParameter('enc_key', $value);
    }

    /**
     * @return string
     */
    public function getIntegratorId()
    {
        return $this->getParameter('integrator_id');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setIntegratorId($value)
    {
        return $this->setParameter('integrator_id', $value);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getParameter('version');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }

    /**
     * @return string
     */
    public function getInvoiceId()
    {
        return $this->getParameter('invoice_id');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setInvoiceId($value)
    {
        return $this->setParameter('invoice_id', $value);
    }

    /**
     * @return string
     */
    public function getCardReference()
    {
        return $this->getParameter('custid');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setCardReference($value)
    {
        return $this->setParameter('custid', $value);
    }

    /**
     * @return \Omnipay\Common\CreditCard|\Omnipay\Paytrace\Check|null
     */
    protected function getBillingSource()
    {
        return null; // @codeCoverageIgnore
    }

    /**
     * @return array
     */
    protected function getBillingData()
    {
        $data = [
            'AMOUNT' => $this->getAmount(),
            'DESCRIPTION' => $this->getDescription(),
            'INVOICE' => $this->getInvoiceId(),
        ];

        $source = $this->getBillingSource();
        if (!$source) {
            return $data; // @codeCoverageIgnore
        }

        $data['BNAME'] = $source->getBillingName();
        $data['PHONE'] = $source->getPhone();
        $data['EMAIL'] = $source->getEmail();

        $data['BADDRESS'] = $source->getBillingAddress1();
        $data['BADDRESS2'] = $source->getBillingAddress2();
        $data['BCITY'] = $source->getBillingCity();
        $data['BCOUNTRY'] = $source->getBillingCountry();
        $data['BSTATE'] = $source->getBillingState();
        $data['BZIP'] = $source->getBillingPostcode();

        $data['SADDRESS'] = $source->getShippingAddress1();
        $data['SADDRESS2'] = $source->getShippingAddress2();
        $data['SCITY'] = $source->getShippingCity();
        $data['SCOUNTRY'] = $source->getShippingCountry();
        $data['SSTATE'] = $source->getShippingState();
        $data['SZIP'] = $source->getShippingPostcode();

        return $data;
    }
}
