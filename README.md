# Lalamove PHP API #

This provides a PHP wrapper around the Lalamove API.

Built and maintained by [Foodkit](https://foodkit.io).

## Design goals ##

* **Lean on the IDE**. We should leverage the IDE (autocompletion) to _help_ the developer to use the library.
* **Hide the transport mechanism (HTTP) as much as possible**. Except when absolutely necessary (e.g endpoint configuration, request timeouts), the end user should not be worried about HTTP concepts when using the library.
* **Interface should be pleasant (or at least unobtrusive) to use**. The library should remove as much friction from the development process as possible.


## Running the tests ##

```
$ ./vendor/bin/phpunit tests/
PHPUnit 7.0.2 by Sebastian Bergmann and contributors.

...........                                                       11 / 11 (100%)

Time: 116 ms, Memory: 4.00MB

OK (11 tests, 23 assertions)
```

## Using the library ##

```php
<?php

$settings = new \Lalamove\Client\V2\Settings(
    'https://sandbox-rest.lalamove.com',
    // These are fake, don't try and use them:
    'wgmsqqh208fxic9vcqwruk2tciicielf', // customerId
    'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==', // privateKey
    \Lalamove\Client\V2\Settings::COUNTRY_SINGAPORE // country
);

$client = new Lalamove\Client\V2\Client($settings);

// Create a quote:
$quotation = new \Lalamove\Quotation();
// ...prepare the quotation object...
$quotationResponse = $client->quotations()->create($quotation);

// Create an order:
$order = \Lalamove\Order::makeFromQuote($quotation, $quotationResponse, 'unique-order-id', false);
$orderResponse = $client->orders()->create($order);

// Fetch order details:
$details = $client->orders()->details($orderResponse->customerOrderId);

// Get the driver:
$driver = $client->drivers()->get($orderResponse->customerOrderId, $details->driverId);
$driverLocation = $client->drivers()->getLocation($orderResponse->customerOrderId, $details->driverId);

// Cancel the order:
$details = $client->orders()->cancel($orderResponse->customerOrderId);
```

## Errors ##

The client library will throw exceptions in the case of request (or server) errors.

```php
try {
    $client->orders()->create($order);
} catch (\Lalamove\Exceptions\PaymentRequiredException $ex) {
    echo 'Error: not enough funds in Lalamove wallet to create the order';
}
```

You can handle these independently (see exceptions in `src/Exceptions/`), or just catch the supertype `Lalamove\Exceptions\LalamoveException` to handle all failure cases.

```php
try {
    $client->orders()->create($order);
} catch (\Lalamove\Exceptions\LalamoveException $ex) {
    echo "Error: I don't know what happened, but the request failed for some reason.";
}
```

## Contributing ##

Open a PR against master. Please use PSR-x conventions for everything and include tests.

