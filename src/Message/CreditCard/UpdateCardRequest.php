<?php
namespace cartthrob\omnipay\paytrace\Message\CreditCard;

/** @psalm-suppress PropertyNotSetInConstructor */
class UpdateCardRequest extends CreateCardRequest
{
    protected $type = 'UpdateCustomer';
}
