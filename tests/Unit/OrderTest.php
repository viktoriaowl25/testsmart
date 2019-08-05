<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderTest extends TestCase
{

    public function testCreateOrder401()
    {
        $data = [
            'products' => [1,2] 
        ];

        $response = $this->json('POST', '/api/orders',$data);
        $response->assertStatus(401);
    }

    public function testCreateOrder403()
    {
        $data = [
            'products' => [1,2], 
            'api_token' => '123456789' 
        ];

        $response = $this->json('POST', '/api/orders',$data);
        $response->assertStatus(403);
    }

    public function testUpdateStatus()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);

        $data = [
            'products' => [1,2], 
            'api_token' => $user->api_token 
        ];

        $response = $this->json('POST', '/api/orders',$data);
        $response->assertStatus(200);

        $order = $response->getData()[0];

        $dataChange = [
            'status_id' => 3, 
            'api_token' => $user->api_token 
        ];

        $response = $this->json('PUT', '/api/orders/' . $order->id, $dataChange);
        $response->assertStatus(200);
    }

    public function testUpdateUser()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);

        $data = [
            'products' => [1,2], 
            'api_token' => $user->api_token 
        ];

        $response = $this->json('POST', '/api/orders',$data);
        $response->assertStatus(200);

        $order = $response->getData()[0];

        $dataChange = [
            'user_id' => 1, 
            'api_token' => $user->api_token 
        ];

        $response = $this->json('PUT', '/api/orders/' . $order->id, $dataChange);
        $response->assertStatus(422);
    }
    
}
