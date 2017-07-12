<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsernameTest extends TestCase
{
    /**
     * Tests the getFullName()
     *
     * @return void
     */
    public function testFullName()
    {
		$user = \App\User::find(2);		

        $this->assertEquals('Estevan Junges', $user->getFullName());
    }

	/**
     * Tests the user_name
     *
     * @return void
     */
    public function testUserName()
    {
		$user = \App\User::find(2);		

        $this->assertEquals('estevan.junges', $user->user_name);
    }
}
