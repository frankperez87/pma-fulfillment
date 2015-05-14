# PMA Fulfillment API

This is an unofficial API for PMA.

####Install via Composer
```
composer require frankperez87/pma-fulfillment
```

####Use Example:

```php

<?php
require 'vendor/autoload.php';

use PMA\Account;
use PMA\BillingAddress;
use PMA\Order;
use PMA\PMA;
use PMA\Product;
use PMA\ShippingAddress;

try {
    // Instantiate PMA Account Class
    $account = new Account('client number here', "username", "password");

    // Instantiate Order Class
    $order = new Order();

    // Set Order Details
    $order->setTransactionNumber('TEST123');
    //$order->setEmail(''); // Optional
    $order->setOrderDate('01-01-2015');
    //$order->setCustomerNumber(''); // Optional
    $order->setOrderType('BULK');
    $order->setPaymentAmount(11.08);
    $order->setShippingAmount(2.50);
    $order->setTaxAmount(2.59);
    $order->setSourceCode('Internet');
    $order->setSource('Internet');

    // Add Products
    $order->addProduct(new Product('PROD123', 1, 5.99));

    // Instantiate Shipping Class
    $shipping = new ShippingAddress();
    //$shipping->setAttn('Test'); Optional
    $shipping->setFirstName('Frank');
    $shipping->setLastName('Test'); // Optional
    $shipping->setAddressOne('123 Main Street');
    //$shipping->setAddressTwo(''); // Optional
    $shipping->setCity('Davie');
    $shipping->setState('FL');
    $shipping->setZip('33314');
    $shipping->setCountry('USA');
    //$shipping->setPhoneNumber(''); // Optional
    $shipping->setAddressType('RESIDENTIAL');
    $shipping->setShipMethod('UPSMI');

    // Instantiate Shipping Class
    $billing = new BillingAddress();
    $billing->setFirstName('Frank');
    $billing->setLastName('Test'); // Optional
    $billing->setAddressOne('123 Main Street');
    //$billing->setAddressTwo(''); // Optional
    $billing->setCity('Davie');
    $billing->setState('FL');
    $billing->setZip('33314');
    $billing->setCountry('USA');

    // Add Shipping and Billing Objects to Order
    $order->addShippingAddress($shipping);
    $order->addBillingAddress($billing);

    $pma = new PMA($account);
    $pma->setOrder($order);
    $response = $pma->send();

} catch(InvalidArgumentException $e) {
    echo $e->getMessage(); // Outputs any errors returned
}
?>
```