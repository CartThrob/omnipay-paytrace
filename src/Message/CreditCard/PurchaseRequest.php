<?php

namespace unionco\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class PurchaseRequest extends AuthorizeRequest
{
    /** @var string */
    protected $type = 'Sale';
}
