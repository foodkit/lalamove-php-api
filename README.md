# Lalamove PHP API #

## Design goals ##

* **Lean on the IDE**. We should leverage the IDE (specifically autocompletion) to _help_ the developer to use the library.
* **Hide the transport mechanism (HTTP) as much as possible**. Except when absolutely necessary (e.g endpoint configuration, request timeouts), the end user should not be worried about HTTP concepts when using the library.
* **Interface should be pleasing (or at least unobtrusive) to use**. The library should remove friction from the end users' lives.


## Running the tests ##

```
$ ./vendor/bin/phpunit tests/Unit/
```

## Using the library ##

```php
<?php

$settings = new \Lalamove\Client\Settings(
    'https://sandbox-rest.lalamove.com',
    'akfjdubhdmakfjdubhdmakfjdubhdmff',
    'ASJFH22JGjskFFbjsk44i9i9skAAvjbjsjs+JFDSJjrweu9jfksjkfsdjjslboui',
    'th'
);

$client = new Lalamove\Client\Client($settings);

$response = $client->quotations()->create([]);

if ($response === false) {
    echo 'There was an error while trying to create the quotation.';
    print_r($client->getLastException()->getMessage());
} else {
    echo 'Successfully created a quotation:';
    print_r($response);
}
```

## Errors ##

```php

```

## Contributing ##

TBA

