# Lalamove PHP API #

This provides a PHP wrapper around the Lalamove API.

Built and maintained by [Foodkit](https://foodkit.io).

## Development progress ##

This library is still a WORK IN PROGRESS. We're in the process of porting our Internal client library across into this public version and expect to be ready for a v1.0 release in late-April.

## Design goals ##

* **Lean on the IDE**. We should leverage the IDE (autocompletion) to _help_ the developer to use the library.
* **Hide the transport mechanism (HTTP) as much as possible**. Except when absolutely necessary (e.g endpoint configuration, request timeouts), the end user should not be worried about HTTP concepts when using the library.
* **Interface should be pleasant (or at least unobtrusive) to use**. The library should remove as much friction from the development process as possible.


## Running the tests ##

```
$ ./vendor/bin/phpunit tests/
PHPUnit 7.0.2 by Sebastian Bergmann and contributors.

.......                                                             7 / 7 (100%)

Time: 83 ms, Memory: 4.00MB

OK (7 tests, 17 assertions)
```

## Using the library ##

```php
<?php

$settings = new \Lalamove\Client\Settings(
    'https://sandbox-rest.lalamove.com',
    'wgmsqqh208fxic9vcqwruk2tciicielf',
    'kGEX69NLd33+J/FQGdx8jOLAO1JZVPrHzQpuZDrWGxlftbu2tKFiVkptTSfPaj==',
    \Lalamove\Client\Settings::COUNTRY_SINGAPORE
);

$client = new Lalamove\Client\Client($settings);

$quotation = $client->quotations()->create([]);
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

