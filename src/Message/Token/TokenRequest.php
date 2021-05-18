<?php

namespace Omnipay\Paytrace\Message\Token;

use Omnipay\Paytrace\Message\AbstractRequest;
use Omnipay\Paytrace\Message\Response;

/**
 * PayPal REST Token Request
 *
 * With each API call, you’ll need to set request headers, including
 * an OAuth 2.0 access token. Get an access token by using the OAuth
 * 2.0 client_credentials token grant type with your clientId:secret
 * as your Basic Auth credentials.
 */
class TokenRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     */
    public function getData()
    {
        return [
            'grant_type' => 'password',
            'username' => $this->getUserName(),
            'password' => $this->getPassword(),
        ];
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . '/oauth/token';
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     */
    public function sendData($data)
    {
        $body = $data ? http_build_query($data, '', '&') : null;

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            [
                'Accept' => 'application/json',
            ],
            $body
        );

        // Empty response body should be parsed also as and empty array
        $body = (string)$httpResponse->getBody()->getContents();

        $jsonToArrayResponse = !empty($body) ? json_decode($body, true) : [];

        return $this->response = new TokenResponse($this, $jsonToArrayResponse, $httpResponse->getStatusCode());
    }
}
