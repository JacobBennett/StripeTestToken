<?php

namespace JacobBennett;

use JacobBennett\StripeCardNumber;
use Stripe\Stripe;
use Stripe\Token;

/**
 * Quickly create Stripe test tokens
 *
 * reference https://stripe.com/docs/testing#cards
 */
class StripeTestToken
{
    public static function setApiKey($key)
    {
        Stripe::setApiKey($key);
    }

    public static function __callStatic($method, $args)
    {
        return self::create($method, isset($args[0]) ? $args[0] : []);
    }

    public static function create($type, $args = [])
    {
        return Token::create([
            'card' => array_merge([
                'number'        => self::getCardNumber($type),
                'exp_month'     => 1,
                'exp_year'      => date("Y") + 1,
                'address_line1' => '33 Zonda Lane',
                'address_zip'   => '44883',
                'cvc'           => '123',
            ], $args)
        ])->id;
    }

    public static function getCardNumber($cardType)
    {
        return StripeCardNumber::{$cardType}();
    }
}
