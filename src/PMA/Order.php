<?php

namespace PMA;

use InvalidArgumentException;

class Order
{

    protected $customer_number;
    protected $order_type;
    protected $payment_type = 'SHIP ONLY';
    protected $amount;
    protected $shipping_amount;
    protected $tax_amount;
    protected $source_code;
    protected $source;
    protected $products = [];
    protected $shipping_address;
    protected $billing_address;
    protected $transaction_number;
    protected $email;
    protected $order_date;

    public function setCustomerNumber($customer_number)
    {
        $this->guardAgainstInvalidCustomerNumber($customer_number);
        $this->customer_number = $customer_number;
    }

    public function getCustomerNumber()
    {
        return $this->customer_number;
    }

    private function guardAgainstInvalidCustomerNumber($customer_number)
    {
        if ($this->isInvalidCustomerNumber($customer_number))
            throw new InvalidArgumentException('Invalid customer number.');
    }

    private function isInvalidCustomerNumber($customer_number)
    {
        return !$this->isValidCustomerNumber($customer_number);
    }

    private function isValidCustomerNumber($customer_number)
    {
        return preg_match('/^([a-z0-9]{1,15})$/i', $customer_number);
    }

    public function setOrderType($order_type)
    {
        $this->guardAgainstInvalidOrderType($order_type);
        $this->order_type = $order_type;
    }

    public function getOrderType()
    {
        return $this->order_type;
    }

    private function guardAgainstInvalidOrderType($order_type)
    {
        if ($this->isInvalidOrderType($order_type))
            throw new InvalidArgumentException('Invalid order type. Allowed types are: BULK, RESPONSE, EDI.');
    }

    private function isInvalidOrderType($order_type)
    {
        return !$this->isValidOrderType($order_type);
    }

    private function isValidOrderType($order_type)
    {
        return in_array($order_type, ['BULK', 'RESPONSE', 'EDI'], true);
    }

    public function getPaymentType()
    {
        return $this->payment_type;
    }

    public function setPaymentAmount($amount)
    {
        $this->guardAgainstInvalidDollarAmount($amount);
        $this->amount = $amount;
    }

    public function getPaymentAmount()
    {
        return $this->amount;
    }

    private function guardAgainstInvalidDollarAmount($amount)
    {
        if ($this->isInvalidDollarAmount($amount))
            throw new InvalidArgumentException('Invalid dollar amount supplied. Must be a float.');
    }

    private function isInvalidDollarAmount($amount)
    {
        return !$this->isValidDollarAmount($amount);
    }

    private function isValidDollarAmount($amount)
    {
        return is_float($amount);
    }

    public function setShippingAmount($shipping_amount)
    {
        $this->guardAgainstInvalidDollarAmount($shipping_amount);
        $this->shipping_amount = $shipping_amount;
    }

    public function getShippingAmount()
    {
        return $this->shipping_amount;
    }

    public function setTaxAmount($tax_amount)
    {
        $this->guardAgainstInvalidDollarAmount($tax_amount);
        $this->tax_amount = $tax_amount;
    }

    public function getTaxAmount()
    {
        return $this->tax_amount;
    }

    public function setSourceCode($source_code)
    {
        $this->guardAgainstInvalidSourceCode($source_code);
        $this->source_code = $source_code;
    }

    public function getSourceCode()
    {
        return $this->source_code;
    }

    private function guardAgainstInvalidSourceCode($source_code)
    {
        if (strlen($source_code) > 30)
            throw new InvalidArgumentException('Invalid input for Source Code. Max length 30 characters.');
    }

    public function setSource($source)
    {
        $this->guardAgainstInvalidSource($source);
        $this->source = $source;
    }

    public function getSource()
    {
        return $this->source;
    }

    private function guardAgainstInvalidSource($source)
    {
        if (strlen($source) > 40)
            throw new InvalidArgumentException('Invalid input for Source. Max length 40 characters.');
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function addShippingAddress(ShippingAddress $shipping_address)
    {
        $this->shipping_address = $shipping_address;
    }

    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function addBillingAddress(BillingAddress $billing_address)
    {
        $this->billing_address = $billing_address;
    }

    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    public function setTransactionNumber($transaction_number)
    {
        $this->transaction_number = $transaction_number;
    }

    public function getTransactionNumber()
    {
        return $this->transaction_number;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setOrderDate($order_date)
    {
        $this->order_date = $order_date;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }
}
