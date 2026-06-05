<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingTest extends TestCase
{
    public function test_customer_rooms_redirects_to_login_when_guest(): void
    {
        $response = $this->get('/customer/rooms');

        $response->assertRedirect('/login');
    }
}