<?php

namespace Tests\Browser;

use App\Question;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class QuestionTest extends DuskTestCase
{
    public function testAddQuestion(){
        $user = factory(User::class)->make([
            'email' => 'testAddQ@test.com',
        ]);
        $user->save();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('Post New')
                ->assertPathIs('/question/create')
                ->type('body', 'Question created')
                ->press('Post')
                ->assertPathIs('/home');
        });
        Question::where('user_id',($user->id))->first()->delete();
        $user->delete();
    }
}
