<?php

namespace Omnipay\Paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';
}
