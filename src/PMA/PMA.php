<?php

namespace PMA;

use GuzzleHttp\Client;

class PMA
{

    protected $account;
    protected $order;
    protected $guzzle;

    const API_URL = 'https://api.pmafulfillment.com/incoming.php';

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->guzzle = new Client;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function send()
    {
        $data = [
            'user' => $this->account->getUser(),
            'password' => $this->account->getPassword(),
            'transno' => $this->order->getTransactionNumber(),
            'email' => $this->order->getEmail(),
            'orderdate' => $this->order->getOrderDate(),
            'sfirstname' => $this->order->getShippingAddress()->getFirstName(),
            'slastname' => $this->order->getShippingAddress()->getLastName(),
            'sadd1' => $this->order->getShippingAddress()->getAddressOne(),
            'sadd2' => $this->order->getShippingAddress()->getAddressTwo(),
            'scity' => $this->order->getShippingAddress()->getCity(),
            'sstate' => $this->order->getShippingAddress()->getState(),
            'spostalcode' => $this->order->getShippingAddress()->getZip(),
            'scountry' => $this->order->getShippingAddress()->getCountry(),
            'phone' => $this->order->getShippingAddress()->getPhoneNumber(),
            'addresstype' => $this->order->getShippingAddress()->getAddressType(),
            'shipmethod' => $this->order->getShippingAddress()->getShipMethod(),
            'clientno' => $this->account->getClientNumber(),
            'custno' => $this->order->getCustomerNumber(),
            'ordertype' => $this->order->getOrderType(),
            'paymenttype' => $this->order->getPaymentType(),
            'bfirstname' => $this->order->getBillingAddress()->getFirstName(),
            'blastname' => $this->order->getBillingAddress()->getLastName(),
            'badd1' => $this->order->getBillingAddress()->getAddressOne(),
            'badd2' => $this->order->getBillingAddress()->getAddressTwo(),
            'bcity' => $this->order->getBillingAddress()->getCity(),
            'bstate' => $this->order->getBillingAddress()->getState(),
            'bpostalcode' => $this->order->getBillingAddress()->getZip(),
            'bcountry' => $this->order->getBillingAddress()->getCountry(),
            'payamount' => $this->order->getPaymentAmount(),
            'shipping' => $this->order->getShippingAmount(),
            'tax' => $this->order->getTaxAmount(),
            'sourcecode' => $this->order->getSourceCode(),
            'source' => $this->order->getSource(),
        ];

        $counter = 1;
        foreach($this->order->getProducts() as $product) {
            $data['productcode' . $counter] = $product->getCode();
            $data['qty' . $counter] = $product->getQuantity();
            $data['price' . $counter] = $product->getPrice();
            $counter++;
        }

        $response = $this->getResponse($data);

        return $response;
    }

    private function getResponse($data)
    {
        $response = $this->guzzle->post(self::API_URL, ['body' => $data]);
        $output = preg_split('/\s*<br>\s*/', $response->getBody(true));
        return $output;
    }
}
