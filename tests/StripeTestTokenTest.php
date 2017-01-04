<?php

use JacobBennett\StripeTestToken;

class StripeTestTokenTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_throws_an_exception_when_requesting_a_non_existent_card_type()
    {
        $this->setExpectedException(\BadMethodCallException::class);

        StripeTestToken::getCardNumber('someNonExistentCardType');
    }

    /** @test */
    public function it_returns_a_valid_visa_card_number()
    {
        $this->assertSame(4012888888881881, StripeTestToken::getCardNumber('validVisa'));
    }

    /** @test */
    public function it_returns_a_token_id_for_a_valid_visa()
    {
        $this->assertFalse(trim(getenv('STRIPE_KEY')) === '', 'You must set the STRIPE_KEY in phpunit.xml');

        StripeTestToken::setApiKey(getenv('STRIPE_KEY'));

        $this->assertTrue(is_string(StripeTestToken::create('validVisa')));
    }
}