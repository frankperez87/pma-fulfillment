<?php

namespace spec\PMA;

use PhpSpec\ObjectBehavior;
use PMA\Account;
use PMA\Order;
use Prophecy\Argument;

class PMASpec extends ObjectBehavior
{
    function let(Account $account)
    {
        $this->beConstructedWith($account);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PMA\PMA');
    }

    function it_allows_you_to_set_order(Order $order)
    {
        $this->setOrder($order);
    }
}
