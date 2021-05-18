<?php

namespace Omnipay\Paytrace;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Paytrace\Message\Token\TokenRequest;

class AbstractGateway extends \Omnipay\Common\AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'PayTrace Payments';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => '',
            'testMode' => false,
            'endpoint' => 'https://api.paytrace.com/',
            'token' => '',
        ];
    }

    /**
     * @return AbstractRequest
     */
    public function authorize(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\CreditCard\AuthorizeRequest',
            $params
        );
    }

    /**
     * @return AbstractRequest
     */
    public function createCard(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\CreditCard\CreateCardRequest',
            $params
        );
    }

    /**
     * @return AbstractRequest
     */
    public function updateCard(array $params = [])
    {
        return $this->createRequest(
            '\Omnipay\Paytrace\Message\CreditCard\UpdateCardRequest',
            $params
        );
    }

    /**
     * @return AbstractRequest
     */
    public function capture(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\CreditCard\CaptureRequest', $params);
    }

    /**
     * @return AbstractRequest
     */
    public function purchase(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\CreditCard\PurchaseRequest', $params);
    }

    /**
     * @return AbstractRequest
     */
    public function void(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\CreditCard\VoidRequest', $params);
    }

    /**
     * @return AbstractRequest
     */
    public function refund(array $params = [])
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\CreditCard\RefundRequest', $params);
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

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getParameter('version');
    }

    /**
     * @param string $value
     * @return AbstractGateway
     */
    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }

    /**
     * Get OAuth 2.0 access token.
     *
     * @param bool $createIfNeeded [optional] - If there is not an active token present, should we create one?
     * @return string
     */
    public function getToken($createIfNeeded = false)
    {
        if ($createIfNeeded && !$this->hasToken()) {
            $response = $this->createToken()->send();

            if ($response->isSuccessful()) {
                $data = $response->getData();

                if (isset($data['access_token'])) {
                    $this->setToken($data['access_token']);
                    $this->setTokenExpires(time() + $data['expires_in']);
                }
            }
        }

        return $this->getParameter('token');
    }

    /**
     * Create OAuth 2.0 access token request.
     *
     * @return \Omnipay\Paytrace\Message\Token\TokenRequest
     */
    public function createToken()
    {
        return $this->createRequest('\Omnipay\Paytrace\Message\Token\TokenRequest', []);
    }

    /**
     * Set OAuth 2.0 access token.
     *
     * @param string $value
     * @return RestGateway provides a fluent interface
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * Get OAuth 2.0 access token expiry time.
     *
     * @return int
     */
    public function getTokenExpires()
    {
        return $this->getParameter('tokenExpires');
    }

    /**
     * Set OAuth 2.0 access token expiry time.
     *
     * @param int $value
     * @return RestGateway provides a fluent interface
     */
    public function setTokenExpires($value)
    {
        return $this->setParameter('tokenExpires', $value);
    }

    /**
     * Is there a bearer token and is it still valid?
     *
     * @return bool
     */
    public function hasToken()
    {
        $token = $this->getParameter('token');

        $expires = $this->getTokenExpires();
        if (!empty($expires) && !is_numeric($expires)) {
            $expires = strtotime($expires);
        }

        return !empty($token) && time() < $expires;
    }

    /**
     * Create Request
     *
     * This overrides the parent createRequest function ensuring that the OAuth
     * 2.0 access token is passed along with the request data -- unless the
     * request is a TokenRequest in which case no token is needed. If no
     * token is available then a new one is created (e.g. if there has been no
     * token request or the current token has expired).
     *
     * @param string $class
     * @return \Omnipay\Paytrace\Message\AbstractRequest
     */
    public function createRequest($class, array $parameters = [])
    {
        if (!$this->hasToken() && $class != '\Omnipay\Paytrace\Message\Token\TokenRequest') {
            // This will set the internal token parameter which the parent
            // createRequest will find when it calls getParameters().
            $this->getToken(true);
        }

        return parent::createRequest($class, $parameters);
    }
}
