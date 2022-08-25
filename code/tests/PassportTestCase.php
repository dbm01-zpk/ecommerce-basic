<?php
namespace Tests;

use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\Shared\UserMother;
use Tests\TestCase;

class PassportTestCase extends TestCase {
    use DatabaseTransactions;

    protected $headers = [];
    protected $scopes  = [];
    protected $user;

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

        $this->user                     = (new UserMother)->create();
        $token                          = $this->user->createToken('TestToken', $this->scopes)->accessToken;
        $this->headers['Accept']        = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . $token;

    }

    public function get($uri, array $headers = []) {
        return parent::get($uri, array_merge($this->headers, $headers));
    }

    public function postJsonAuth($uri, array $data, array $headers = []) {
        return $this->postJson(
            $uri,
            $data,
            array_merge($this->headers, $headers)
        );
    }

}