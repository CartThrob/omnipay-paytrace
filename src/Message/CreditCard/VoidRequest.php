<?php

namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';
}
