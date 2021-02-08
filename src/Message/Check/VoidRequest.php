<?php

namespace Omnipay\Paytrace\Message\Check;

/** @psalm-suppress PropertyNotSetInConstructor */
class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';
}
