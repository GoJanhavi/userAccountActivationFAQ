<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSave()
    {
        $user = factory(\App\User::class)->make();
        $this->assertTrue($user->save());
    }

    public function testProfile()
    {
        $user = factory(\App\User::class)->make();
        $this->assertTrue(is_object($user->profile()->get()));
    }
    public function testQuestion()
    {
        $user = factory(\App\User::class)->make();
        $this->assertTrue(is_object($user->question()->get()));
    }
    public function testAnswer()
    {
        $user = factory(\App\User::class)->make();
        $this->assertTrue(is_object($user->answer()->get()));
    }


    public function testAuthenticationSuccess()
    {
        $user = factory(\App\User::class)->create([
            'email'=> 'abc@abc.com',
            'password' => bcrypt($password = 'abcdef'),
        ]);

        $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);
    }


}

