<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\Shared\UserMother;
use Tests\TestCase;

class RegistrationTest extends TestCase {

    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $client           = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', ''
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id'  => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_be_render() {
        $response = $this->get('/auth/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register() {

        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy()
        );

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'success' => true,
        ]);

    }

    public function test_new_users_not_same_password() {

        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(c_password:'change')
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => "The c password and password must match.",
        ]);

    }

    public function test_duplicate_user() {

        $this->postJson(
            '/api/register',
            (new UserMother)->dummy(email:'same@email.com')
        );

        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(email:'same@email.com')
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            "message" => "The email has already been taken.",
        ]);

    }

    public function test_email_bad_format() {

        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(email:'sameemail')
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            "message" => "The email must be a valid email address.",
        ]);

    }

    public function test_new_users_invalid_password() {

        $password = 'min8';
        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(password:$password, c_password:$password)
        );

        $response->assertStatus(422);

        $password = 'noupper&nonumber';
        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(password:$password, c_password:$password)
        );

        $response->assertStatus(422);

        $password = '022NOLOWER';
        $response = $this->postJson(
            '/api/register',
            (new UserMother)->dummy(password:$password, c_password:$password)
        );

        $response->assertStatus(422);

    }

}
