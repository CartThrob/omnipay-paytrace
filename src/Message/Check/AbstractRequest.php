<?php

namespace Omnipay\Paytrace\Message\Check;

use Omnipay\Paytrace\Check;

abstract class AbstractRequest extends \Omnipay\Paytrace\Message\AbstractRequest
{
    protected $responseClass = 'Omnipay\Paytrace\Message\Check\Response';

    /**
     * @return \Omnipay\Paytrace\Check|null
     */
    public function getCheck()
    {
        return $this->getParameter('check');
    }

    /**
     * @param mixed $value
     * @return self
     */
    public function setCheck($value)
    {
        if ($value && !$value instanceof Check) {
            $value = new Check($value);
        }

        return $this->setParameter('check', $value);
    }

    /**
     * @return Check|null
     */
    protected function getBillingSource()
    {
        return $this->getCheck();
    }

    /**
     * @return array
     *
     * @psalm-return array{TERMS: string, UN: mixed, PSWD: mixed, METHOD: mixed, CHECKTYPE: mixed}
     */
    protected function getBaseData()
    {
        return [
            'TERMS' => 'Y',
            'UN' => $this->getUserName(),
            'PSWD' => $this->getPassword(),
            'METHOD' => $this->method,
            'CHECKTYPE' => $this->type,
        ];
    }
}
