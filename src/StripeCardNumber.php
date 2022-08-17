<?php

namespace JacobBennett;

use BadMethodCallException;

/**
 * Provide access to varying valid and exceptional card numbers
 * independently of having to actually create a Stripe token.
 * 
 * @method static int validVisa()
 * @method static int validVisaDebit()
 * @method static int validMastercard()
 * @method static int validMastercardDebit()
 * @method static int validMastercardPrepaid()
 * @method static int validAmex()
 * @method static int validDiscover()
 * @method static int validDinersClub()
 * @method static int validJCB()
 * @method static int successDirectToBalance()
 * @method static int addressZipFail()
 * @method static int addressFail()
 * @method static int zipFail()
 * @method static int addressZipUnavailable()
 * @method static int cvcFail()
 * @method static int customerChargeFail()
 * @method static int successWithReview()
 * @method static int declineCard()
 * @method static int declineFraudulentCard()
 * @method static int declineIncorrectCvc()
 * @method static int declineExpiredCard()
 * @method static int declineProcessingError()
 * @method static int declineIncorrectNumber()
 * @method static int scaAuthOneTimePayments()
 * @method static int scaAuthRequired()
 * @method static int scaAuthOnSession()
 * 
 * @see https://stripe.com/docs/testing#cards
 */
class StripeCardNumber
{
    const CARDS = [
        // valid cards
        'validVisa'              => 4012888888881881,
        'validVisaDebit'         => 4012888888881881,
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

        // SCA
        'scaAuthOneTimePayments' => 4000002500003155,
        'scaAuthRequired'        => 4000002760003184,
        'scaAuthOnSession'       => 4000003800000446,
    ];

    public static function __callStatic($method, $args)
    {
        if (! array_key_exists($method, static::CARDS)) {
            throw new BadMethodCallException("The provided card type {$method} is not defined.");
        }

        return static::CARDS[$method];
    }
}
