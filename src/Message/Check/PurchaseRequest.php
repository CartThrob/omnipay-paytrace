<?php

namespace Omnipay\Paytrace\Message\Check;

/** @psalm-suppress PropertyNotSetInConstructor */
class PurchaseRequest extends AuthorizeRequest
{
    protected $type = 'Sale';
}
