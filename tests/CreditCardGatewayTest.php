<?php

namespace Omnipay\Paytrace;

class CreditCardGatewayTest extends \Omnipay\Tests\GatewayTestCase
{
    /** @var  CreditCardGateway */
    protected $gateway;
    protected $options;

    public function setUp()
    {
        $this->gateway = new CreditCardGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setPassword('demo123')
            ->setUserName('demo123')
            ->setTestMode(true);
        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
    }

    public function testAuthorizeSuccess()
    {
        $this->setMockHttpResponse('Credit_AuthorizeResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $response = $this->gateway->authorize($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('104', $response->getCode());
        $this->assertSame(
            'Your TEST transaction was successfully approved. HOWEVER, A LIVE APPROVAL WAS NOT OBTAINED.',
            $response->getMessage()
        );
    }

    public function testAuthorizeFailure()
    {
        $this->setMockHttpResponse('ResponseFailed.txt');

        $this->gateway->setPassword('111');
        $response = $this->gateway->authorize($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('998', $response->getCode());
        $this->assertSame('Log in failed.', $response->getMessage());
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('Credit_AuthorizeResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('104', $response->getCode());
        $this->assertSame(
            'Your TEST transaction was successfully approved. HOWEVER, A LIVE APPROVAL WAS NOT OBTAINED.',
            $response->getMessage()
        );
    }

    public function testPurchaseCreditReferenceSuccess()
    {
        $this->setMockHttpResponse('Credit_AuthorizeResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $options = array_merge(array('cardReference' => 1234567890), $this->options);
        $response = $this->gateway->purchase($options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('104', $response->getCode());
        $this->assertSame(
            'Your TEST transaction was successfully approved. HOWEVER, A LIVE APPROVAL WAS NOT OBTAINED.',
            $response->getMessage()
        );
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('ResponseFailed.txt');

        $this->gateway->setPassword('111');
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('998', $response->getCode());
        $this->assertSame('Log in failed.', $response->getMessage());
    }

    public function testRefundSuccess()
    {
        $this->setMockHttpResponse('Credit_RefundResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $response = $this->gateway->refund($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\CaptureResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('108', $response->getCode());
        $this->assertSame(
            'Your TEST transaction was successfully refunded. HOWEVER, NO FUNDS WILL BE REFUNDED.',
            $response->getMessage()
        );
    }

    public function testRefundTransactionReferenceSuccess()
    {
        $this->setMockHttpResponse('Credit_RefundResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $options = array_merge(array('transactionReference' => 89731989), $this->options);
        unset($options['card']);
        $response = $this->gateway->refund($options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\CaptureResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('89731989', $response->getTransactionReference());
        $this->assertSame('108', $response->getCode());
        $this->assertSame(
            'Your TEST transaction was successfully refunded. HOWEVER, NO FUNDS WILL BE REFUNDED.',
            $response->getMessage()
        );
    }

    public function testRefundFailure()
    {
        $this->setMockHttpResponse('ResponseFailed.txt');

        $this->gateway->setPassword('111');
        $response = $this->gateway->refund($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\CaptureResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('998', $response->getCode());
        $this->assertSame('Log in failed.', $response->getMessage());
    }

    public function testCreateCardSuccess()
    {
        $this->setMockHttpResponse('CreateCardResponseSuccess.txt');

        $this->gateway->setPassword('demo123');
        $response = $this->gateway->createCard($this->options)->send();
        $this->assertInstanceOf('\Omnipay\Paytrace\Message\CreditCard\CreateCardResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('160', $response->getCode());
        $this->assertSame('14496097', $response->getCardReference());
        $this->assertSame(
            'The customer profile for 14496097\/John Doe was successfully created.',
            $response->getMessage()
        );
    }
}
