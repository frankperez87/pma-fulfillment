<?php

namespace PMA;

use PMA\Traits\Address;
use PMA\Traits\Validator;

class ShippingAddress
{
    use Validator;
    use Address;

    protected $phone_number;
    protected $address_type;
    protected $ship_method;

    public function setPhoneNumber($phone_number)
    {
        $this->guardAgainstInvalidPhoneNumber($phone_number);
        $this->phone_number = $phone_number;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setAddressType($address_type)
    {
        $this->guardAgainstInvalidAddressType($address_type);
        $this->address_type = $address_type;
    }

    public function getAddressType()
    {
        return $this->address_type;
    }

    public function setShipMethod($ship_method)
    {
        $this->ship_method = $ship_method;
    }

    public function getShipMethod()
    {
        return $this->ship_method;
    }
}
