<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends DuskTestCase
{
    public function testCreateProfile(){
        $user = factory(User::class)->make([
            'email' => 'testAddProfile@test.com',
        ]);
        $user->save();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('My Account')
                ->clickLink('Create Profile')
                ->type('first_name','TestFirstName')
                ->type('last_name','TestLastName')
                ->type('body','Test content for About Me')
                ->press('Save')
                ->assertPathIs('/home');
        });

        $user->delete();
    }

}
