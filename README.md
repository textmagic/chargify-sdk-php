# Chargify SDK for PHP

[![Total Downloads](https://img.shields.io/packagist/dt/textmagic/chargify-sdk-php.svg?style=flat)](https://packagist.org/packages/textmagic/chargify-sdk-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/textmagic/chargify-sdk-php.svg?style=flat)](https://packagist.org/packages/textmagic/chargify-sdk-php)
[![Apache 2 License](https://img.shields.io/packagist/l/textmagic/chargify-sdk-php.svg?style=flat)](https://github.com/textmagic/chargify-sdk-php/blob/master/LICENSE.md)

This repository is a continuation of the original [Chargify SDK for PHP][chargify-sdk-php] 

A list of differences from the original Chargify SDK for PHP:

    added support for PHP 7.2 and Guzzle 7
    removed support of deprecated Chargify Direct (v2)

# Installation

Using [Composer][composer-homepage] is the recommended way to install the Chargify SDK for PHP. Composer is a 
dependency management tool for PHP that allows you to declare the dependencies your project needs and installs them 
into your project. In order to use the SDK with Composer, you must do the following:

1. Install Composer, if you don't already have it:

	```bash
	curl -sS https://getcomposer.org/installer | php
	```

1. Run the Composer command to install the latest stable version of the SDK:

	```bash
	php composer.phar require textmagic/chargify-sdk-php
	```

1. Require Composer's autoloader:

	```php
	<?php
	require '/path/to/vendor/autoload.php';
	```

# Quick Example

Create a new customer.

```php
<?php
require 'vendor/autoload.php';

use Crucial\Service\Chargify;

$chargify = new Chargify([
    'hostname'   => 'yoursubdomain.chargify.com',
    'api_key'    => '{{API_KEY}}',
    'shared_key' => '{{SHARED_KEY}}'
]);

// Crucial\Service\Chargify\Customer
$customer = $chargify->customer()
    // set customer properties
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setEmail('john.doe@mailinator.com')
    // send the create request
    ->create();

// check for errors
if ($customer->isError()) {
    // array of errors loaded during the transfer
    $errors = $customer->getErrors();
 } else {
    // the transfer was successful
    $customerId = $customer['id']; // Chargify customer ID
    $firstName  = $customer['first_name'];
    $lastName   = $customer['last_name'];
    $email      = $customer['email'];
 }

```

[composer-homepage]: https://getcomposer.org
[chargify-sdk-php]: https://github.com/crucialwebstudio/chargify-sdk-php