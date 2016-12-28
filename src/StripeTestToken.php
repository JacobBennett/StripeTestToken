<?php

namespace JacobBennett;

use Stripe\Token;

/**
 * Quickly create Stripe test tokens
 * 
 * reference https://stripe.com/docs/testing#cards
 */
class StripeTestToken
{

    private static $apiKey;

    const CARDS = [
        
        // valid cards
        'validVisa'              => 4012888888881881,
        'validVisaDebit'         => 4000056655665556,
        'validMastercard'        => 5555555555554444,
        'validMastercardDebit'   => 5200828282828210,
        'validMastercardPrepaid' => 5105105105105100,
        'validAmex'              => 378282246310005,
        'validDiscover'          => 6011111111111117,
        'validDinersClub'        => 30569309025904,
        'validJCB'               => 3530111333300000,

        // exceptional responses
        'successDirectToBalance' => 4000000000000077,
        'addressZipFail'         => 4000000000000010,
        'addressFail'            => 4000000000000028,
        'zipFail'                => 4000000000000036,
        'addressZipUnavailable'  => 4000000000000044,
        'cvcFail'                => 4000000000000101,
        'customerChargeFail'     => 4000000000000341,
        'successWithReview'      => 4000000000009235,
        'declineCard'            => 4000000000000002,
        'declineFraudulentCard'  => 4100000000000019,
        'declineIncorrectCvc'    => 4000000000000127,
        'declineExpiredCard'     => 4000000000000069,
        'declineProcessingError' => 4000000000000119,
        'declineIncorrectNumber' => 4242424242424241,
    ];

    public static function setApiKey($key)
    {
        self::$apiKey = $key;
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
                'exp_month'     => 1,
                'exp_year'      => date("Y") + 1,
                'address_line1' => '33 Zonda Lane',
                'address_zip'   => '44883',
                'cvc'           => '123',
            ]
        ], ['api_key' => self::$apiKey])->id;
    }

    public static function getCardNumber($type)
    {
        if (!isset(self::CARDS[$cardType]))
        {
            throw new \BadMethodCallException("The provided method {$type} was not found.");
        }

        return self::CARDS[$cardType];
    }
}