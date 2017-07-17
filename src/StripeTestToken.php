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
        return self::create($method, $args);
    }

    public static function create($type, $args = [])
    {
        return Token::create([
            'card' => [
                'number'          => self::getCardNumber($type),
                'exp_month'       => 1,
                'exp_year'        => date("Y") + 1,
                'name'            => isset($args[0]['name']) ? $args[0]['name'] : '',
                'address_line1'   => isset($args[0]['address_line1']) ? $args[0]['address_line1'] : '33 Zonda Lane',
                'address_line2'   => isset($args[0]['address_line2']) ? $args[0]['address_line2'] : '',
                'address_city'    => isset($args[0]['address_city']) ? $args[0]['address_city'] : 'Zondaville',
                'address_state'   => isset($args[0]['address_state']) ? $args[0]['address_state'] : 'AR',
                'address_zip'     => isset($args[0]['address_zip']) ? $args[0]['address_zip'] : '44883',
                'address_country' => isset($args[0]['address_country']) ? $args[0]['address_country'] : 'US',
                'cvc'             => '123',
            ]
        ])->id;
    }

    public static function getCardNumber($cardType)
    {
        return StripeCardNumber::{$cardType}();
    }
}