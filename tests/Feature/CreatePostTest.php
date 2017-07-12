<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostTest extends TestCase
{
    /**
    *
    * @test testNotAuthenticated
    */
    public function testNotAuthenticated()
    {        
        $response = $this->get('/post/create');
        
        $this->assertFalse($response->status() == 200);
    }

	/**
    *
    * @test testAuthenticated
    */
    public function testAuthenticated()
    {
        $user = \App\User::find(2);
        
        $response = $this->actingAs($user)->get('/post/create');
        
        $response->assertStatus(200);
    }
}