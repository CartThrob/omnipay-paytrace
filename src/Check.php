<?php

namespace Omnipay\Paytrace;

use Omnipay\Common\Helper;
use Omnipay\Paytrace\Exception\InvalidCheckException;
use Symfony\Component\HttpFoundation\ParameterBag;

class Check
{
    /** @var ParameterBag $parameters */
    protected $parameters;

    /**
     * @param null|array $parameters
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * @param null|array $parameters
     * @return self
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();
        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @param string $key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @param string $key
     * @param null|string $value
     *
     * @return self
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingNumber()
    {
        return $this->getParameter('routingNumber');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setRoutingNumber($value)
    {
        return $this->setParameter('routingNumber', $value);
    }

    /**
     * @return string
     */
    public function getBankAccount()
    {
        return $this->getParameter('bankAccount');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBankAccount($value)
    {
        return $this->setParameter('bankAccount', $value);
    }

    /**
     * @return void
     */
    public function validate()
    {
        foreach (['routingNumber', 'bankAccount', 'billingFirstName', 'billingLastName'] as $key) {
            if (!$this->getParameter($key)) {
                throw new InvalidCheckException("The $key parameter is required");
            }
        }

        if (strlen($this->getRoutingNumber()) !== 9) {
            throw new InvalidCheckException("Invalid Bank Routing Number");
        }
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getBillingFirstName();
    }

    /**
     * @param string $value
     * @return self
     */
    public function setFirstName($value)
    {
        $this->setBillingFirstName($value);
        $this->setShippingFirstName($value);

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getBillingLastName();
    }

    /**
     * @param string $value
     * @return self
     */
    public function setLastName($value)
    {
        $this->setBillingLastName($value);
        $this->setShippingLastName($value);

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBillingName();
    }

    /**
     * @param string $value
     * @return self
     */
    public function setName($value)
    {
        $this->setBillingName($value);
        $this->setShippingName($value);

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingName()
    {
        return trim($this->getBillingFirstName() . ' ' . $this->getBillingLastName());
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingName($value)
    {
        $names = explode(' ', $value, 2);
        $this->setBillingFirstName($names[0]);
        $this->setBillingLastName(isset($names[1]) ? $names[1] : null);

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingFirstName()
    {
        return $this->getParameter('billingFirstName');
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setBillingFirstName($value)
    {
        return $this->setParameter('billingFirstName', $value);
    }

    /**
     * @return string
     */
    public function getBillingLastName()
    {
        return $this->getParameter('billingLastName');
    }

    /**
     * @param null|string $value
     *
     * @return self
     */
    public function setBillingLastName($value)
    {
        return $this->setParameter('billingLastName', $value);
    }

    /**
     * @return string
     */
    public function getBillingCompany()
    {
        return $this->getParameter('billingCompany');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingCompany($value)
    {
        return $this->setParameter('billingCompany', $value);
    }

    /**
     * @return string
     */
    public function getBillingAddress1()
    {
        return $this->getParameter('billingAddress1');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingAddress1($value)
    {
        return $this->setParameter('billingAddress1', $value);
    }

    /**
     * @return string
     */
    public function getBillingAddress2()
    {
        return $this->getParameter('billingAddress2');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingAddress2($value)
    {
        return $this->setParameter('billingAddress2', $value);
    }

    /**
     * @return string
     */
    public function getBillingCity()
    {
        return $this->getParameter('billingCity');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingCity($value)
    {
        return $this->setParameter('billingCity', $value);
    }

    /**
     * @return string
     */
    public function getBillingPostcode()
    {
        return $this->getParameter('billingPostcode');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingPostcode($value)
    {
        return $this->setParameter('billingPostcode', $value);
    }

    /**
     * @return string
     */
    public function getBillingState()
    {
        return $this->getParameter('billingState');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingState($value)
    {
        return $this->setParameter('billingState', $value);
    }

    /**
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->getParameter('billingCountry');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingCountry($value)
    {
        return $this->setParameter('billingCountry', $value);
    }

    /**
     * @return string
     */
    public function getBillingPhone()
    {
        return $this->getParameter('billingPhone');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingPhone($value)
    {
        return $this->setParameter('billingPhone', $value);
    }

    /**
     * @return string
     */
    public function getBillingFax()
    {
        return $this->getParameter('billingFax');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setBillingFax($value)
    {
        return $this->setParameter('billingFax', $value);
    }

    /**
     * @return string
     */
    public function getShippingTitle()
    {
        return $this->getParameter('shippingTitle');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingTitle($value)
    {
        return $this->setParameter('shippingTitle', $value);
    }

    /**
     * @return string
     */
    public function getShippingName()
    {
        return trim($this->getShippingFirstName() . ' ' . $this->getShippingLastName());
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingName($value)
    {
        $names = explode(' ', $value, 2);
        $this->setShippingFirstName($names[0]);
        $this->setShippingLastName(isset($names[1]) ? $names[1] : '');

        return $this;
    }

    /**
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->getParameter('shippingFirstName');
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setShippingFirstName($value)
    {
        return $this->setParameter('shippingFirstName', $value);
    }

    /**
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->getParameter('shippingLastName');
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setShippingLastName($value)
    {
        return $this->setParameter('shippingLastName', $value);
    }

    /**
     * @return string
     */
    public function getShippingCompany()
    {
        return $this->getParameter('shippingCompany');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingCompany($value)
    {
        return $this->setParameter('shippingCompany', $value);
    }

    /**
     * @return string
     */
    public function getShippingAddress1()
    {
        return $this->getParameter('shippingAddress1');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingAddress1($value)
    {
        return $this->setParameter('shippingAddress1', $value);
    }

    /**
     * @return string
     */
    public function getShippingAddress2()
    {
        return $this->getParameter('shippingAddress2');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingAddress2($value)
    {
        return $this->setParameter('shippingAddress2', $value);
    }

    /**
     * @return string
     */
    public function getShippingCity()
    {
        return $this->getParameter('shippingCity');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingCity($value)
    {
        return $this->setParameter('shippingCity', $value);
    }

    /**
     * @return string
     */
    public function getShippingPostcode()
    {
        return $this->getParameter('shippingPostcode');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingPostcode($value)
    {
        return $this->setParameter('shippingPostcode', $value);
    }

    /**
     * @return string
     */
    public function getShippingState()
    {
        return $this->getParameter('shippingState');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingState($value)
    {
        return $this->setParameter('shippingState', $value);
    }

    /**
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->getParameter('shippingCountry');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingCountry($value)
    {
        return $this->setParameter('shippingCountry', $value);
    }

    /**
     * @return string
     */
    public function getShippingPhone()
    {
        return $this->getParameter('shippingPhone');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingPhone($value)
    {
        return $this->setParameter('shippingPhone', $value);
    }

    /**
     * @return string
     */
    public function getShippingFax()
    {
        return $this->getParameter('shippingFax');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setShippingFax($value)
    {
        return $this->setParameter('shippingFax', $value);
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->getParameter('billingAddress1');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setAddress1($value)
    {
        $this->setParameter('billingAddress1', $value);
        $this->setParameter('shippingAddress1', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->getParameter('billingAddress2');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setAddress2($value)
    {
        $this->setParameter('billingAddress2', $value);
        $this->setParameter('shippingAddress2', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->getParameter('billingCity');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setCity($value)
    {
        $this->setParameter('billingCity', $value);
        $this->setParameter('shippingCity', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->getParameter('billingPostcode');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setPostcode($value)
    {
        $this->setParameter('billingPostcode', $value);
        $this->setParameter('shippingPostcode', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->getParameter('billingState');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setState($value)
    {
        $this->setParameter('billingState', $value);
        $this->setParameter('shippingState', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->getParameter('billingCountry');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setCountry($value)
    {
        $this->setParameter('billingCountry', $value);
        $this->setParameter('shippingCountry', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getParameter('billingPhone');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setPhone($value)
    {
        $this->setParameter('billingPhone', $value);
        $this->setParameter('shippingPhone', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->getParameter('billingFax');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setFax($value)
    {
        $this->setParameter('billingFax', $value);
        $this->setParameter('shippingFax', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->getParameter('billingCompany');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setCompany($value)
    {
        $this->setParameter('billingCompany', $value);
        $this->setParameter('shippingCompany', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }
}
