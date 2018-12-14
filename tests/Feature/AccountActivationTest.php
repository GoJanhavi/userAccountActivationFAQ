<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Mail\VerifyAndActivate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\User;

class AccountActivationTest extends TestCase
{
    public function testVerifyUser()
    {
        $user = new User([
            'email' => 'gk.janvi009@gmail.com',
            'password' => 'janhavi',
            'user_activation_token' => 'abcd1234565878tgrhfoyg8t'
        ]);
        $this->assertTrue($user->save());
        Mail::fake();

        Mail::to($user->email)->send(new VerifyAndActivate($user));

        Mail::assertSent(VerifyAndActivate::class);

        $response = $this->get(url('user/verify', $user->user_activation_token));

        $response->assertStatus(302);

        $this->assertTrue($user->delete());

    }
}
