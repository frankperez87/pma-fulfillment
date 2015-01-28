<?php

namespace PMA;

class Product
{

    protected $code;
    protected $quantity;
    protected $price_each;

    public function __construct($code, $quantity, $price_each)
    {
        $this->code = $code;
        $this->quantity = $quantity;
        $this->price_each = $price_each;
    }

    public function getPrice()
    {
        return $this->price_each;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getCode()
    {
        return $this->code;
    }
}
