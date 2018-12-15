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

    public function testEditQuestion(){
        $user = factory(User::class)->make([
            'email' => 'testEditQ@test.com',
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
                ->type('body', 'Question to be edited')
                ->press('Post')
                ->assertPathIs('/home');

        });
        $question = Question::where('user_id',($user->id))->first();

        $this->browse(function ($browser) use ($user, $question) {
            $question_id = $question->id;
            $browser->visit('/home')
                ->clickLink('View')
                ->clickLink('Edit')
                ->type('body', 'Question edited')
                ->press('Post')
                ->assertRouteIs('question.show', ['id' => $question_id]);
        });

        $question->delete();
        $user->delete();
    }


    public function testDeleteQuestion(){
        $user = factory(User::class)->make([
            'email' => 'testDeleteQ@test.com',
        ]);
        $user->save();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home');
        });
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/home')
                ->clickLink('Post New')
                ->assertPathIs('/question/create')
                ->type('body', 'Question to be deleted')
                ->press('Post')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->press('Delete')
                ->assertPathIs('/home');
        });

        $user->delete();
    }

}
