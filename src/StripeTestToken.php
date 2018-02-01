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
        return self::create($method);
    }

    public static function create($type)
    {
        return Token::create([
            'card' => [
                'number'        => self::getCardNumber($type),
                'name'          => 'Princess Zelda',
                'exp_month'     => 1,
                'exp_year'      => date("Y") + 1,
                'address_line1' => '33 Zonda Lane',
                'address_zip'   => '44883',
                'cvc'           => '123',
            ]
        ])->id;
    }

    public static function getCardNumber($cardType)
    {
        return StripeCardNumber::{$cardType}();
    }
}
