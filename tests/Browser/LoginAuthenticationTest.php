<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Mail;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginAuthenticationTest extends DuskTestCase
{
    public function testUserVerification(){


        $this->browse(function ($browser)  {
            $browser->visit('/register')
                ->type('email', 'testUserVerify@test.com')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('Register');

        });

        $user= User::where('email','testUserVerify@test.com')->first();

        $this->browse(function ($browser)  use($user){
            $userToken= $user->user_activation_token;
            $browser->visit(url('user/verify', $userToken))
                ->assertPathIs('/login');
        });

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home');
        });


        $user->delete();
    }

    public function testUserLogin()
    {
        $user = factory(User::class)->make([
            'email' => 'testLogin@test.com',
        ]);
        $user->save();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home');
        });

        $user->delete();
    }



}
