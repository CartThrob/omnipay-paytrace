<?php

namespace cartthrob\omnipay\paytrace\Message;

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
            'MIME-Version' => '1.0',
            'Content-type' => 'application/x-www-form-urlencoded',
            'Contenttransfer-encoding' => 'text',
        ];
        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            $headers,
            'parmlist=' . $this->preparePostData($data)
        );

        $responseClass = $this->responseClass;

        /**
         * @var ResponseInterface
         * @psalm-suppress InvalidStringClass
         **/
        $response = new $responseClass($this, $httpResponse->getBody());
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
    public function getInvoiceId()
    {
        return $this->getParameter('invoiceId');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setInvoiceId($value)
    {
        return $this->setParameter('invoiceId', $value);
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
     * @return \Omnipay\Common\CreditCard|\cartthrob\omnipay\paytrace\Check|null
     */
    protected function getBillingSource()
    {
        return null; // @codeCoverageIgnore
    }

    /**
     * @return array
     *
     * @psalm-return array{AMOUNT: string, DESCRIPTION: string, INVOICE: mixed, BNAME?: mixed, PHONE?: mixed, EMAIL?: mixed, BADDRESS?: mixed, BADDRESS2?: mixed, BCITY?: mixed, BCOUNTRY?: mixed, BSTATE?: mixed, BZIP?: mixed, SADDRESS?: mixed, SADDRESS2?: mixed, SCITY?: mixed, SCOUNTRY?: mixed, SSTATE?: mixed, SZIP?: mixed}
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

    /**
     * @param array $data
     * @return string
     */
    protected function preparePostData($data)
    {
        $postData = '';
        foreach ($data as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $postData .= urlencode("{$key}~{$value}|");
        }
        return $postData;
    }
}
