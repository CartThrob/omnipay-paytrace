<?php

namespace unionco\omnipay\paytrace\Message\Check;

/** @psalm-suppress PropertyNotSetInConstructor */
class VoidRequest extends CaptureRequest
{
    protected $type = 'Void';
}
