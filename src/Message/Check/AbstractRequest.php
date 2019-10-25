<?php

namespace unionco\omnipay\paytrace\Message\Check;

use unionco\omnipay\paytrace\Check;

abstract class AbstractRequest extends \unionco\omnipay\paytrace\Message\AbstractRequest
{
    protected $responseClass = 'unionco\omnipay\paytrace\Message\Check\Response';

    /**
     * @return \unionco\omnipay\paytrace\Check|null
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
