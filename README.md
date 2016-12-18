# Stripe Test Tokens

TODO: 
- travis-ci
- scrutinizer
- packagist images
- badges
- update readme

## About

Use this to quickly create Stripe test tokens for Succesful and exceptional responses from Stripe.

## Install
```bash
composer require jacobbennett/stripe-test-token
```

## Usage
```php
<?php

// set your api key
\Stripe\Stripe::setApiKey('your_stripe_secret_test_key');

// get your token
$token = \JacobBennett\StripeTestToken::validVisa();

// fake a charge
\Stripe\Charge::create([
	'amount' => 500,
	'curreny' => 'usd',
	'source' => $token,
]);

```

## Testing

Copy your [Stripe Credentials](https://dashboard.stripe.com/account/apikeys)


### License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

