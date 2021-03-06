<?php

namespace spec\PMA;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BillingAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PMA\BillingAddress');
    }

    function it_allows_you_to_set_a_first_name()
    {
        $this->setFirstName('First Name');
        $this->getFirstName()->shouldReturn('First Name');
    }

    function it_validates_first_name()
    {
        $this->shouldThrow(new InvalidArgumentException('First Name is longer then the allowed length of 35.'))
             ->during('setFirstName', ['This is a test This is a test This is a test This is a test']);
    }

    function it_allows_you_to_set_a_last_name()
    {
        $this->setLastName('Last Name');
        $this->getLastName()->shouldReturn('Last Name');
    }

    function it_validates_last_name()
    {
        $this->shouldThrow(new InvalidArgumentException('Last Name is longer then the allowed length of 35.'))
            ->during('setLastName', ['This is a test This is a test This is a test This is a test']);
    }

    function it_allows_you_to_set_a_address_line_one()
    {
        $this->setAddressOne('123 Main Street');
        $this->getAddressOne()->shouldReturn('123 Main Street');
    }

    function it_validates_address_line_one()
    {
        $this->shouldThrow(new InvalidArgumentException('Address One is longer then the allowed length of 35.'))
             ->during('setAddressOne', ['This is a test This is a test This is a test This is a test']);
    }

    function it_allows_you_to_set_a_address_line_two()
    {
        $this->setAddressTwo('Suite 123');
        $this->getAddressTwo()->shouldReturn('Suite 123');
    }

    function it_validates_address_line_two()
    {
        $this->shouldThrow(new InvalidArgumentException('Address Two is longer then the allowed length of 35.'))
             ->during('setAddressTwo', ['This is a test This is a test This is a test This is a test']);
    }

    function it_allows_you_to_set_a_city()
    {
        $this->setCity('Test City');
        $this->getCity()->shouldReturn('Test City');
    }

    function it_validates_city()
    {
        $this->shouldThrow(new InvalidArgumentException('City is longer then the allowed length of 25.'))
             ->during('setCity', ['This is a test This is a test This is a test This is a test']);
    }

    function it_allows_you_to_set_a_state()
    {
        $this->setState('FL');
        $this->getState()->shouldReturn('FL');
    }

    function it_validates_state()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid state provided.'))
             ->during('setState', ['FLA']);
    }

    function it_allows_you_to_set_a_zip_code()
    {
        $this->setZip(11111);
        $this->getZip()->shouldReturn(11111);
    }

    function it_validates_before_setting_zip()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid zip code provided.'))
             ->during('setZip', ['1111111']);

        $this->shouldThrow(new InvalidArgumentException('Invalid zip code provided.'))
            ->during('setZip', ['11111-11111']);
    }

    function it_validates_zip_code_formats()
    {
        $this->isValidZip(11111)->shouldReturn(1);
        $this->isValidZip(111111)->shouldReturn(1);
        $this->isValidZip('11111-1111')->shouldReturn(1);
        $this->isValidZip('1111 111')->shouldReturn(1);
        $this->isValidZip('111 111')->shouldReturn(1);
        $this->isValidZip('A111 1B1')->shouldReturn(1);
        $this->isValidZip('A1B A2B')->shouldReturn(1);
        $this->isValidZip('A1BA2B')->shouldReturn(0);
    }

    function it_allows_you_to_set_a_country()
    {
        $this->setCountry('USA');
        $this->getCountry()->shouldReturn('USA');
    }

    function it_validates_country()
    {

        $this->shouldThrow(new InvalidArgumentException('Invalid country code provided.'))
            ->during('setCountry', ['US']);

        $this->shouldThrow(new InvalidArgumentException('Invalid country code provided.'))
            ->during('setCountry', ['usa']);
    }

}
