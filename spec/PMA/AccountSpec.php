<?php

namespace spec\PMA;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountSpec extends ObjectBehavior
{
    protected $client_number = '123';
    protected $user = 'TESTUSER';
    protected $password = 'TESTPASS';

    function let()
    {
        $this->beConstructedWith($this->client_number, $this->user, $this->password);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('PMA\Account');
    }

    function it_can_retrieve_a_client_number()
    {
        $this->getClientNumber()->shouldReturn($this->client_number);
    }

    function it_validates_the_client_number()
    {
        $this->shouldThrow(new \InvalidArgumentException('Invalid client number provided. Must be at most 3 numeric characters.'))
             ->during('setClientNumber', ['1111']);

        $this->shouldThrow(new \InvalidArgumentException('Invalid client number provided. Must be at most 3 numeric characters.'))
            ->during('setClientNumber', ['A12']);
    }

    function it_can_retrieve_a_user_name()
    {
        $this->getUser()->shouldReturn($this->user);
    }

    function it_can_retrieve_a_password()
    {
        $this->getPassword()->shouldReturn($this->password);
    }

    function it_can_set_a_username()
    {
        $this->setUser('ABC');
        $this->getUser()->shouldReturn('ABC');
    }

    function it_validates_the_username()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid username provided.'))
            ->during('setUser', ['aaaaaaaaaaaaaaaaaaaaa']);
    }
}
