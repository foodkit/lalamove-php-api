# Lalamove PHP API #

This provides a PHP wrapper around the Lalamove API.

Built and maintained by [Foodkit](https://foodkit.io).

## Development progress ##

This library is still a _WORK IN PROGRESS_. We're in the process of porting our Internal client library across into this public version and expect to be ready for a v1.0 release in late-April. Feel free to use the library before then but please note that the API may change.

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

$settings = new \Lalamove\Client\Settings(
    'https://sandbox-rest.lalamove.com',
    // These are fake, don't try and use them:
    'wgmsqqh208fxic9vcqwruk2tciicielf', // customerId
    'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==', // privateKey
    \Lalamove\Client\Settings::COUNTRY_SINGAPORE // country
);

$client = new Lalamove\Client\Client($settings);

// Create a quote:
$quotationResponse = $client->quotations()->create($quotation);

// Create an order:
$order = \Lalamove\Order::makeFromQuote($quotation, $quotationResponse, 'unique-order-id');
$orderResponse = $client->orders()->create($order);

// Fetch order details:
$details = $client->orders()->details($orderResponse->customerOrderId);

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

