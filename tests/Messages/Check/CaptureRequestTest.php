<?php

namespace cartthrob\omnipay\paytrace\Message\Check;

use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    /** @var  \cartthrob\omnipay\paytrace\Message\Check\CaptureRequest $request */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetData()
    {
        $expectedData = [
            'username' => 'tester',
            'password' => 'testpwd',
            'transactionReference' => '32167',
            'testmode' => 1,
        ];

        $this->request->initialize($expectedData);
        $data = $this->request->getData();

        $this->assertSame($expectedData['transactionReference'], $data['CHECKID']);
        $this->assertSame($expectedData['username'], $data['UN']);
        $this->assertSame($expectedData['password'], $data['PSWD']);
        $this->assertSame('ManageCheck', $data['METHOD']);
        $this->assertSame('Fund', $data['CHECKTYPE']);
    }
}
