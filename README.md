![](https://raw.githubusercontent.com/JacobBennett/StripeTestToken/master/stripetesttoken-01.jpg)

# Stripe Test Tokens
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jacobbennett/stripe-test-token.svg?maxAge=2592000?style=flat-square)](https://packagist.org/packages/jacobbennett/stripe-test-token)
[![Travis](https://img.shields.io/travis/JacobBennett/StripeTestToken.svg?maxAge=2592000?style=flat-square)](https://travis-ci.org/JacobBennett/StripeTestToken)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Use this to quickly create Stripe test tokens for successful and exceptional responses from Stripe.

## Install
```bash
composer require jacobbennett/stripe-test-token
```

## Usage
```php
<?php

use JacobBennett\StripeTestToken;
use Stripe\Charge;

StripeTestToken::setApiKey('your_stripe_secret_test_key');

// Fake a Successful Charge

Charge::create([
        'amount' => 500,
        'curreny' => 'usd',
        'source' => StripeTestToken::validVisa(),
]);


// Fake a Failing Charge

try {

        Charge::create([
                'amount' => 500,
                'curreny' => 'usd',
                'source' => StripeTestToken::cvcFail(),
        ]);

} catch (\Stripe\Error\Card $e) {
        // handle errors
}

```

## Docs 

> Find full descriptions at original [Stripe Docs Reference](https://stripe.com/docs/testing#cards)

### Using Methods

To use any of the methods below, call the listed method as a static on the `StripeTestToken` class. If you only want to return the corresponding card number, such as with Selenium or Laravel Dusk, you can call the same method on the `StripeCardNumber` class.

```php
<?php 

\JacobBennett\StripeCardNumber::validVisa(); // Returns the valid Visa card number 4012888888881881
\JacobBennett\StripeTestToken::validVisa(); // Attempts to generate a token against the Stripe API for a valid Visa card
```

### Test card numbers
Genuine card information cannot be used in test mode. Instead, use any of the following test card methods to create a successful payment token:

| Method |
| --- |
| validVisa |
| validVisaDebit |
| validMastercard |
| validMastercardDebit |
| validMastercardPrepaid |
| validAmex |
| validDiscover |
| validDinersClub |
| validJCB |

### Testing for specific responses and errors

The following methods can be used to create tokens that produce specific responses—useful for testing different scenarios and error codes. Verification checks only run when the required information is provided (e.g., for `cvc_check` to fail, a CVC code must be provided).

| Method | Description |
| --- | --- |
| successDirectToBalance | Charge succeeds and funds will be added directly to your available balance (bypassing your pending balance). |
| addressZipFail | The `address_line1_check` and `address_zip_check` verifications fail. If your account is [blocking payments that fail ZIP code validation](https://stripe.com/docs/radar/rules#traditional-bank-checks), the charge is declined. |
| addressFail | Charge succeeds but the `address_line1_check` verification fails. |
| zipFail | The `address_zip_check` verification fails. If your account is [blocking payments that fail ZIP code validation](https://stripe.com/docs/radar/rules#traditional-bank-checks), the charge is declined. |
| addressZipUnavailable | Charge succeeds but the `address_zip_check` and `address_line1_check` verifications are both unavailable. |
| cvcFail | If a CVC number is provided, the `cvc_check` fails. If your account is [blocking payments that fail CVC code validation](https://stripe.com/docs/radar/rules#traditional-bank-checks), the charge is declined. |
| customerChargeFail | Attaching this card to a [Customer](https://stripe.com/docs/api#customer_object) object succeeds, but attempts to charge the customer fail. |
| successWithReview | Charge succeeds with a `risk_level` of elevated and [placed into review](https://stripe.com/docs/radar/review). |
| declineCard | Charge is declined with a `card_declined` code. |
| declineFraudulentCard | Charge is declined with a `card_declined` code and a `fraudulent` reason. |
| declineIncorrectCvc | Charge is declined with an `incorrect_cvc` code. |
| declineExpiredCard | Charge is declined with an `expired_card` code. |
| declineProcessingError | Charge is declined with a `processing_error` code. |
| declineIncorrectNumber | Charge is declined with an `incorrect_number` code as the card number fails the [Luhn check](https://en.wikipedia.org/wiki/Luhn_algorithm). |

## Testing

In order to run the full test suite, you must have `STRIPE_KEY` set in your environment, as the test will hit the Stripe API in order to generate a test token.

```
$ STRIPE_KEY=sk_test_YourTestKeyHere phpunit tests/
```

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
