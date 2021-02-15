<?php

namespace Omnipay\Paytrace\Message;

use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    const TRANSACTION_KEY = '';

    /**
     * @param RequestInterface $request
     * @param mixed $data
     * @return self
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return $this->data->transaction_id ?? null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        if (isset($this->data->errors)) {
            foreach ($this->data->errors as $key => $error) {
                return $error[0] ?? $this->data->status_message;
            }
        }

        return $this->data->status_message ?? '';
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->data->response_code ?? null;
    }
}
