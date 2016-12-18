# Stripe Test Tokens

TODO: 
- scrutinizer
- packagist images
- badges
- update readme

## About

Use this to quickly create Stripe test tokens for succesful and exceptional responses from Stripe.

## Install
```bash
composer require jacobbennett/stripe-test-token
```

## Usage
```php
<?php

\JacobBennett\StripeTestToken::setApiKey('your_stripe_secret_test_key');

// Fake a Successful Charge
\Stripe\Charge::create([
	'amount' => 500,
	'curreny' => 'usd',
	'source' => \JacobBennett\StripeTestToken::validVisa(),
]);

try {

	// Fake a Failing Charge
	\Stripe\Charge::create([
		'amount' => 500,
		'curreny' => 'usd',
		'source' => \JacobBennett\StripeTestToken::cvcFail(),
	]);

} catch (\Stripe\Error\Card $e) {
	// handle errors
}

```

### License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

