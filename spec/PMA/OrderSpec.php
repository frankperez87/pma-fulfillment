<?php

namespace spec\PMA;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use PMA\BillingAddress;
use PMA\Product;
use PMA\ShippingAddress;
use Prophecy\Argument;

class OrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PMA\Order');
    }

    function it_allows_you_to_set_a_customer_number()
    {
        $this->setCustomerNumber('A1234567');
        $this->getCustomerNumber()->shouldReturn('A1234567');

        $this->setCustomerNumber('01234567');
        $this->getCustomerNumber()->shouldReturn('01234567');
    }

    function it_validates_customer_number()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid customer number.'))
             ->during('setCustomerNumber', ['AA11111111111111']);

        $this->shouldThrow(new InvalidArgumentException('Invalid customer number.'))
            ->during('setCustomerNumber', ['1111111111111111']);
    }

    function it_allows_you_to_set_the_order_type()
    {
        $this->setOrderType('BULK');
        $this->getOrderType()->shouldReturn('BULK');
    }

    function it_validates_the_order_type()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid order type. Allowed types are: BULK, RESPONSE, EDI.'))
             ->during('setOrderType', ['bulk']);
    }

    function it_allows_you_to_get_payment_type()
    {
        $this->getPaymentType()->shouldReturn('SHIP ONLY');
    }

    function it_allows_you_to_set_a_payment_amount()
    {
        $this->setPaymentAmount(200.20);
        $this->getPaymentAmount()->shouldReturn(200.20);
    }

    function it_validates_payment_amount()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
             ->during('setPaymentAmount', ['200.00']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setPaymentAmount', ['200']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setPaymentAmount', [200]);
    }

    function it_allows_you_to_set_a_shipping_amount()
    {
        $this->setShippingAmount(10.00);
        $this->getShippingAmount()->shouldReturn(10.00);
    }

    function it_validates_the_shipping_amount()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setShippingAmount', ['200.00']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setShippingAmount', ['200']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setShippingAmount', [200]);
    }

    function it_allows_you_to_set_a_tax_amount()
    {
        $this->setTaxAmount(10.00);
        $this->getTaxAmount()->shouldReturn(10.00);
    }

    function it_validates_the_tax_amount()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setTaxAmount', ['200.00']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setTaxAmount', ['200']);

        $this->shouldThrow(new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.'))
            ->during('setTaxAmount', [200]);
    }

    function it_allows_you_to_set_a_source_code()
    {
        $this->setSourceCode('WebOMG');
        $this->getSourceCode()->shouldReturn('WebOMG');
    }

    function it_validates_the_source_code()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid input for Source Code. Max length 30 characters.'))
             ->during('setSourceCode', ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']);
    }

    function it_allows_you_to_set_the_source()
    {
        $this->setSource('Frank');
        $this->getSource()->shouldReturn('Frank');
    }

    function it_validates_the_source()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid input for Source. Max length 40 characters.'))
             ->during('setSource', ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']);
    }

    function it_allows_you_to_add_product(Product $product)
    {
        $this->addProduct($product);
        $this->getProducts()->shouldReturn([$product]);
    }

    function it_allows_you_to_add_a_shipping_address(ShippingAddress $shipping_address)
    {
        $this->addShippingAddress($shipping_address);
        $this->getShippingAddress()->shouldReturn($shipping_address);
    }

    function it_allows_you_to_add_a_billing_address(BillingAddress $billing_address)
    {
        $this->addBillingAddress($billing_address);
        $this->getBillingAddress()->shouldReturn($billing_address);
    }

    function it_should_allow_you_to_set_a_transaction_number()
    {
        $this->setTransactionNumber('ORD12345');
        $this->getTransactionNumber()->shouldReturn('ORD12345');
    }

    function it_should_allow_you_to_set_a_email_address()
    {
        $this->setEmail('test@test.com');
        $this->getEmail()->shouldReturn('test@test.com');
    }

    function it_should_allow_you_to_set_the_order_date()
    {
        $order_date = '01-01-2015';
        $this->setOrderDate($order_date);
        $this->getOrderDate()->shouldReturn($order_date);
    }


}
