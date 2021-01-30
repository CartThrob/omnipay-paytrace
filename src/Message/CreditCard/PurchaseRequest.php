<?php

namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class PurchaseRequest extends AuthorizeRequest
{
    /** @var string */
    protected $type = 'Sale';
}
