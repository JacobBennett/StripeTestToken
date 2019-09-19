<?php

use JacobBennett\StripeTestToken;
use PHPUnit\Framework\TestCase;

class StripeTestTokenTest extends TestCase
{
    /** @test */
    public function it_throws_an_exception_when_requesting_a_non_existent_card_type()
    {
        $this->expectException(\BadMethodCallException::class);

        StripeTestToken::getCardNumber('someNonExistentCardType');
    }

    /** @test */
    public function it_throws_an_exception_when_creating_a_token_with_a_non_existent_card_type_via_static_access()
    {
        $this->expectException(\BadMethodCallException::class);

        StripeTestToken::someNonExistentCardType();
    }

    /** @test */
    public function it_returns_a_valid_visa_card_number()
    {
        $this->assertSame(4012888888881881, StripeTestToken::getCardNumber('validVisa'));
    }

    /** @test */
    public function it_returns_a_token_id_for_a_valid_visa()
    {
        if(! getenv('STRIPE_KEY')) {
            $this->markTestSkipped('You must set the STRIPE_KEY in your environment');
        }

        StripeTestToken::setApiKey(getenv('STRIPE_KEY'));

        $this->assertTrue(is_string(StripeTestToken::create('validVisa')));
    }

    /** @test */
    public function it_returns_a_token_id_for_a_valid_mastercard_using_static_access()
    {
        if(! getenv('STRIPE_KEY')) {
            $this->markTestSkipped('You must set the STRIPE_KEY in your environment');
        }

        StripeTestToken::setApiKey(getenv('STRIPE_KEY'));

        $this->assertTrue(is_string(StripeTestToken::validMastercard()));
    }
}
