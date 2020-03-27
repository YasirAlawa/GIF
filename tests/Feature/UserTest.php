<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use WithoutMiddleware; 


    /**
     * Test login with fake user
     *
     * @return void
     */
    public function testLoginApi()
    {
        $response = $this->post(
        
            '/api/auth/login', 
            [
                'email'=>'yasiralawa@gmail.com',
                'password'=>'1020301'//incorrect password
            ]);

        
        $response->assertSuccessful();
        
        
    }
}
