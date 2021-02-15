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
 *
 * @link https://developer.paypal.com/docs/integration/direct/make-your-first-call/
 * @link https://developer.paypal.com/docs/api/#authentication--headers
 */
class ClientTokenRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . $this->getVersion() . '/payment_fields/token/create';
    }

    /**
     * @return mixed|void
     */
    public function getData()
    {
        return [];
    }

    /**
     * @param mixed $data
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            array(
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken()
            )
        );

        // Empty response body should be parsed also as and empty array
        $body = (string) $httpResponse->getBody()->getContents();

        $jsonToArrayResponse = !empty($body) ? json_decode($body, true) : [];

        return $this->response = new ClientTokenResponse($this, $jsonToArrayResponse, $httpResponse->getStatusCode());
    }
}