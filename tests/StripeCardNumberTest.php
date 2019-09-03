<?php

use JacobBennett\StripeCardNumber;
use PHPUnit\Framework\TestCase;


class StripeCardNumberTest extends TestCase
{
    /** @test */
    public function it_throws_an_exception_for_an_invalid_method()
    {
        $this->expectException(\BadMethodCallException::class);

        StripeCardNumber::someInvalidCardMethod();
    }

    /** @test */
    public function it_returns_a_valid_visa_card_number()
    {
        $this->assertSame(4012888888881881, StripeCardNumber::validVisa());
    }

    /** @test */
    public function it_returns_a_valid_visa_debit_number()
    {
        $this->assertSame(4012888888881881, StripeCardNumber::validVisaDebit());
    }

    /** @test */
    public function it_returns_a_valid_mastercard_number()
    {
        $this->assertSame(5555555555554444, StripeCardNumber::validMastercard());
    }

    /** @test */
    public function it_returns_a_valid_mastercard_debit_number()
    {
        $this->assertSame(5200828282828210, StripeCardNumber::validMastercardDebit());
    }

    /** @test */
    public function it_returns_a_valid_mastercard_prepaid_number()
    {
        $this->assertSame(5105105105105100, StripeCardNumber::validMastercardPrepaid());
    }

    /** @test */
    public function it_returns_a_valid_amex_number()
    {
        $this->assertSame(378282246310005, StripeCardNumber::validAmex());
    }

    /** @test */
    public function it_returns_a_valid_discover_number()
    {
        $this->assertSame(6011111111111117, StripeCardNumber::validDiscover());
    }

    /** @test */
    public function it_returns_a_valid_diners_club_number()
    {
        $this->assertSame(30569309025904, StripeCardNumber::validDinersClub());
    }

    /** @test */
    public function it_returns_a_valid_jcb_number()
    {
        $this->assertSame(3530111333300000, StripeCardNumber::validJCB());
    }

    /** @test */
    public function it_returns_a_success_direct_to_balance_number()
    {
       $this->assertSame(4000000000000077, StripeCardNumber::successDirectToBalance()); 
    }

    /** @test */
    public function it_returns_an_address_zip_fail_number()
    {
        $this->assertSame(4000000000000010, StripeCardNumber::addressZipFail());
    }

    /** @test */
    public function it_returns_an_address_fail_number()
    {
        $this->assertSame(4000000000000028, StripeCardNumber::addressFail());
    }

    /** @test */
    public function it_returns_a_zip_fail_number()
    {
        $this->assertSame(4000000000000036, StripeCardNumber::zipFail());
    }

    /** @test */
    public function it_returns_an_address_zip_unavailable_number()
    {
        $this->assertSame(4000000000000044, StripeCardNumber::addressZipUnavailable());
    }

    /** @test */
    public function it_returns_a_cvc_fail_number()
    {
        $this->assertSame(4000000000000101, StripeCardNumber::cvcFail());
    }

    /** @test */
    public function it_returns_a_customer_charge_fail_number()
    {
        $this->assertSame(4000000000000341, StripeCardNumber::customerChargeFail());
    }

    /** @test */
    public function it_returns_a_success_with_review_number()
    {
        $this->assertSame(4000000000009235, StripeCardNumber::successWithReview());
    }

    /** @test */
    public function it_returns_a_declined_card_number()
    {
        $this->assertSame(4000000000000002, StripeCardNumber::declineCard());
    }

    /** @test */
    public function it_returns_a_declined_fraudulent_card_number()
    {
        $this->assertSame(4100000000000019, StripeCardNumber::declineFraudulentCard());
    }

    /** @test */
    public function it_returns_a_declined_incorrect_cvc_number()
    {
        $this->assertSame(4000000000000127, StripeCardNumber::declineIncorrectCvc());
    }

    /** @test */
    public function it_returns_a_declined_expired_card_number()
    {
        $this->assertSame(4000000000000069, StripeCardNumber::declineExpiredCard());
    }

    /** @test */
    public function it_returns_a_declined_processing_error_number()
    {
        $this->assertSame(4000000000000119, StripeCardNumber::declineProcessingError());
    }

    /** @test */
    public function it_returns_a_declined_incorrect_number()
    {
        $this->assertSame(4242424242424241, StripeCardNumber::declineIncorrectNumber());
    }
}
