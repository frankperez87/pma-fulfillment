<?php

namespace spec\PMA;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    protected $code = '123';
    protected $quantity = 2;
    protected $price_each = 9.99;

    function let()
    {
        $this->beConstructedWith($this->code, $this->quantity, $this->price_each);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PMA\Product');
    }

    function it_allows_you_to_get_price()
    {
        $this->getPrice()->shouldReturn($this->price_each);
    }

    function it_allows_you_to_get_quantity()
    {
        $this->getQuantity()->shouldReturn($this->quantity);
    }

    function it_allows_you_to_get_code()
    {
        $this->getCode()->shouldReturn($this->code);
    }
}
