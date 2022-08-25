<?php

namespace Tests\Feature\ECommerce;

use Tests\PassportTestCase;

class AuthenticatedTest extends PassportTestCase {

    public function test_authenticated_create_product() {

        // $this->user
        $response = $this->postJsonAuth(
            '/api/products',
            [
                'name'        => 'dddd',
                'description' => 'dddd',
                'price'       => 10.00,
            ]
        );

        $response->assertStatus(201);

    }

    public function test_unauthenticated_dont_create_product() {

        // $this->user
        $response = $this->postJson(
            '/api/products',
            [
                'name'        => 'dddd',
                'description' => 'dddd',
                'price'       => 10.00,
            ]
        );

        $response->assertStatus(401);

    }

    public function test_authenticated_dont_create_product_price_string() {

        // $this->user
        $response = $this->postJsonAuth(
            '/api/products',
            [
                'name'        => 'dddd',
                'description' => 'dddd',
                'price'       => 'string_price',
            ]
        );

        $response->assertStatus(422);

    }

}
