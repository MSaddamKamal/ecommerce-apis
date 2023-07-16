<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Modules\Auth\Models\User;
use Laravel\Passport\ClientRepository;
use Carbon\Carbon;
use DB;

abstract class PassportTestCase extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;
    protected $headers = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->setUpAuth();
    }

    protected function setUpAuth()
    {
        $this->setUpClient();
        $this->createLoginUser();
        $this->setUpAuthHeaders();
    }
    protected function setUpClient()
    {
        $clientRepository = new ClientRepository();
        $client =  $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', '/'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    protected function createLoginUser()
    {
        $this->user = User::firstOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'email' => 'test@gmail.com',
                'name' => 'test user',
                'password' => 'password123',
                'password_confirmation' => 'password123'
            ]);
        return $this->user;
    }
    protected function setUpAuthHeaders()
    {
        $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;
    }
}
