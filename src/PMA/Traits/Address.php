<?php

namespace PMA\Traits;

trait Address
{
    protected $first_name;
    protected $last_name;
    protected $address_one;
    protected $address_two;
    protected $city;
    protected $state;
    protected $zip;
    protected $country;

    public function setFirstName($first_name)
    {
        $this->guardAgainstInvalidFirstName($first_name);
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setLastName($last_name)
    {
        $this->guardAgainstInvalidLastName($last_name);
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setAddressOne($address_one)
    {
        $this->guardAgainstInvalidAddressOne($address_one);
        $this->address_one = $address_one;
    }

    public function getAddressOne()
    {
        return $this->address_one;
    }

    public function setAddressTwo($address_two)
    {
        $this->guardAgainstInvalidAddressTwo($address_two);
        $this->address_two = $address_two;
    }

    public function getAddressTwo()
    {
        return $this->address_two;
    }

    public function setCity($city)
    {
        $this->guardAgainstInvalidCity($city);
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setState($state)
    {
        $this->guardAgainstInvalidState($state);
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setZip($zip)
    {
        $this->guardAgainstInvalidZipCode($zip);
        $this->zip = $zip;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setCountry($country)
    {
        $this->guardAgainstInvalidCountry($country);
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }
}
