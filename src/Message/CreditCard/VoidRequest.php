<?php

namespace Omnipay\Paytrace\Message\CreditCard;

class VoidRequest extends CaptureRequest
{
    /** @var string */
    protected $type = 'Void';
}
