<?php

namespace JacobBennett;

use JacobBennett\StripeCardNumber;
use Stripe\Stripe;
use Stripe\Token;

/**
 * Quickly create Stripe test tokens
 * 
 * @method static \Stripe\Token validVisa()
 * @method static \Stripe\Token validVisaDebit()
 * @method static \Stripe\Token validMastercard()
 * @method static \Stripe\Token validMastercardDebit()
 * @method static \Stripe\Token validMastercardPrepaid()
 * @method static \Stripe\Token validAmex()
 * @method static \Stripe\Token validDiscover()
 * @method static \Stripe\Token validDinersClub()
 * @method static \Stripe\Token validJCB()
 * @method static \Stripe\Token successDirectToBalance()
 * @method static \Stripe\Token addressZipFail()
 * @method static \Stripe\Token addressFail()
 * @method static \Stripe\Token zipFail()
 * @method static \Stripe\Token addressZipUnavailable()
 * @method static \Stripe\Token cvcFail()
 * @method static \Stripe\Token customerChargeFail()
 * @method static \Stripe\Token successWithReview()
 * @method static \Stripe\Token declineCard()
 * @method static \Stripe\Token declineFraudulentCard()
 * @method static \Stripe\Token declineIncorrectCvc()
 * @method static \Stripe\Token declineExpiredCard()
 * @method static \Stripe\Token declineProcessingError()
 * @method static \Stripe\Token declineIncorrectNumber()
 * @method static \Stripe\Token scaAuthOneTimePayments()
 * @method static \Stripe\Token scaAuthRequired()
 * @method static \Stripe\Token scaAuthOnSession()
 *
 * @see https://stripe.com/docs/testing#cards
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
                'name'          => 'Pam Beasley',
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
