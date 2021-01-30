<?php

namespace cartthrob\omnipay\paytrace\Message\Check;

/** @psalm-suppress PropertyNotSetInConstructor */
class PurchaseRequest extends AuthorizeRequest
{
    protected $type = 'Sale';
}
