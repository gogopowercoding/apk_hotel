<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_customer_booking_redirects_to_login_when_guest(): void
    {
        $response = $this->get('/customer/bookings');

        $response->assertRedirect('/login');
    }
}