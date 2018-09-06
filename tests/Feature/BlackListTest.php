<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlackList;

class BlackListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckCPFRoute()
    {
        // $response = $this->get('/api/check-cpf');
        // $response
        //     ->assertStatus(422)
        //     ->assertJson([
        //         'status' => 'error',
        //     ]);

        $response = $this->get('/api/check-cpf?cpf=00000000000');
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error',
            ]);

        $blacklistItem = BlackList::find(1);
        $response = $this->get('/api/check-cpf?cpf=' . $blacklistItem->cpf);
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'danger',
            ]);

        $response = $this->get('/api/check-cpf?cpf=797.849.140-42');
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    public function testCreate()
    {
        $response = $this->json('POST', '/api/black-list');
        $response
            ->assertStatus(422)
            ->assertJson([
                'status' => 'error',
            ]);

        $response = $this->json('POST', '/api/black-list', [
            'cpf' => '00000000000'
        ]);        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error',
            ]);
        
        $response = $this->json('POST', '/api/black-list', [
            'cpf' => '059.607.240-65'
        ]);        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    public function testDelete()
    {
        $response = $this->json('DELETE', '/api/black-list/');
        $response
            ->assertStatus(422)
            ->assertJson([
                'status' => 'error',
            ]);

        $response = $this->json('DELETE', '/api/black-list/00000000000');        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error',
            ]);
        
        $response = $this->json('DELETE', '/api/black-list/059.607.240-65');        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);

        $response = $this->json('DELETE', '/api/black-list/059.607.240-65');        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error',
            ]);
    }
}
