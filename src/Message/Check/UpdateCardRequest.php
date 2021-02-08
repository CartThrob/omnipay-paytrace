<?php

namespace Omnipay\Paytrace\Message\Check;

/** @psalm-suppress PropertyNotSetInConstructor */
class UpdateCardRequest extends CreateCardRequest
{
    protected $type = 'UpdateCustomer';
}
