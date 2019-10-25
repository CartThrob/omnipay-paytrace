<?php

namespace unionco\omnipay\paytrace;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\AbstractResponse;

class AbstractGateway extends \Omnipay\Common\AbstractGateway
{
    const GATEWAY_TYPE = '';

    /**
     * @return string
     */
    public function getName()
    {
        return 'PayTrace Check'; // @codeCoverageIgnore
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'testMode' => false,
            'endpoint' => 'https://paytrace.com/api/default.pay',
        );
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function authorize(array $params = [])
    {
        return $this->createRequest(
            '\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\AuthorizeRequest',
            $params
        );
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function createCard(array $params = [])
    {
        return $this->createRequest(
            '\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\CreateCardRequest',
            $params
        );
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function updateCard(array $params = [])
    {
        return $this->createRequest(
            '\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\UpdateCardRequest',
            $params
        );
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function capture(array $params = [])
    {
        return $this->createRequest('\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\CaptureRequest', $params);
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function purchase(array $params = [])
    {
        return $this->createRequest('\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\PurchaseRequest', $params);
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function void(array $params = [])
    {
        return $this->createRequest('\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\VoidRequest', $params);
    }

    /**
     * @param array $params
     * @return AbstractRequest
     */
    public function refund(array $params = [])
    {
        return $this->createRequest('\unionco\omnipay\paytrace\Message\\' . static::GATEWAY_TYPE . '\RefundRequest', $params);
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
     * @return AbstractGateway
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
     * @return AbstractGateway
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
     * @return AbstractGateway
     */
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }
}
