# Lalamove PHP API #

[![CircleCI](https://circleci.com/gh/foodkit/lalamove-php-api/tree/master.svg?style=svg)](https://circleci.com/gh/foodkit/lalamove-php-api/tree/master)

This provides a PHP wrapper around the Lalamove API.

Built and maintained by [Foodkit](https://foodkit.io).

See [https://partnerportal.lalamove.com/](https://partnerportal.lalamove.com/).

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

$settings = new \Lalamove\Client\V3\Settings(
    'https://sandbox-rest.lalamove.com',
    'API_KEY',
    'API_SECRET',
    \Lalamove\Client\V3\Settings::COUNTRY_SINGAPORE // country
);

$client = new Lalamove\Client\V3\Client($settings);

// Create a quote:
$quotation = new \Lalamove\Requests\V3\Quotation();

// ...prepare the quotation object...
$quotationResponse = $client->quotations()->create($quotation);

// Get quotation by id
$quotationDetailsResponse = $client->quotations()->create($quotation->quotationId);

// Create an order
// Provide the quotationID and stopId received from create quote and add contact information for both the sender and recipients
$contact = new \Lalamove\Requests\V3\Contact('Contact Name', '+65991111110', 'stop_id_from_quotation');

// recipient contact and instruction per stop
$recipients = [
    [
        'stopId' => 'stop_id_1',
        'name' => 'name',
        //  Must be a valid number with region code (ex: +65)
        'phone' => '+65991111111',
    ], [
        'stopId' => 'stop_id_2',
        'name' => 'name',
        //  Must be a valid number with region code (ex: +65)
        'phone' => '+65991111112',
    ]
];

$order = new \Lalamove\Requests\V3\Order($quotationId, $sender, $recipients);
$orderResponse = $client->orders()->create($order);

// Fetch order details:
$details = $client->orders()->details($orderResponse->orderId);

// Get the driver:
// driverId from create order or by order details response
$driver = $client->drivers()->get($details->orderId, $details->driverId);

// Cancel the order:
$details = $client->orders()->cancel($orderResponse->orderId);
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
