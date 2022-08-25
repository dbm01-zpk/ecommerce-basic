<?php
namespace Tests\Shared;

use App\Models\User;

class UserMother {

    private $faker;

    public function __construct() {
        $this->faker = \Faker\Factory::create();
    }

    public function dummy(
        string $user = 'Test User 2',
        string $email = 'same_email@example.com',
        string $password = '@Password0022',
        string $c_password = '@Password0022',

    ) {

        return [
            'name'       => $user,
            'email'      => $email,
            'password'   => $password,
            'c_password' => $c_password,
        ];

    }

    public function create() {
        return User::factory()->create();
    }

}