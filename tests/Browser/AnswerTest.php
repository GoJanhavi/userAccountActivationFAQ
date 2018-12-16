<?php

namespace Tests\Browser;

use App\Answer;
use App\Question;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AnswerTest extends DuskTestCase
{
    public function testAddAnswerToQuestion(){
        $user = factory(User::class)->make([
            'email' => 'testAddAnswer@abc.com',
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
                ->type('body', 'Question to be answered')
                ->press('Post')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->clickLink('Post New')
                ->type('body', 'Answer Added')
                ->press('Post')
                ->assertSee("Question answered successfully !!");
        });

        $question = Question::where('user_id',($user->id))->first();
        Answer::where('question_id',($question->id))->delete();
        $question->delete();
        $user->delete();
    }

    public function testEditAnswerToQuestion(){
        $user = factory(User::class)->make([
            'email' => 'testEditAnswer@abc.com',
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
                ->type('body', 'Question to be answered')
                ->press('Post')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->clickLink('Post New')
                ->type('body', 'Answer to be updated')
                ->press('Post')
                ->clickLink('View')
                ->clickLink('Edit')
                ->type('body', 'Answer updated')
                ->press('Post')
                ->assertSee("Answer successfully updated !!");
        });

        $question = Question::where('user_id',($user->id))->first();
        Answer::where('question_id',($question->id))->delete();
        $question->delete();
        $user->delete();
    }

    public function testDeleteAnswer(){
        $user = factory(User::class)->make([
            'email' => 'testEditAnswer@abc.com',
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
                ->type('body', 'Question to be answered')
                ->press('Post')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->clickLink('Post New')
                ->type('body', 'Answer to be deleted')
                ->press('Post')
                ->clickLink('View')
                ->press('Delete')
                ->assertSee("Answer deleted successfully");
        });

        Question::where('user_id',($user->id))->first()->delete();
        $user->delete();
    }

    public function testUserNotAbleToEditOrDeleteOthersAnswer(){
        $user1 = factory(User::class)->make([
            'email' => 'testUserOne@test.com',
        ]);
        $user1->save();

        $user2 = factory(User::class)->make([
            'email' => 'testUserTwoQ@test.com',
        ]);
        $user2->save();

        $this->browse(function ($browser) use ($user1, $user2) {
            $browser->visit('/login')
                ->type('email', $user1->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('Post New')
                ->assertPathIs('/question/create')
                ->type('body', 'Question created')
                ->press('Post')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->clickLink('Post New')
                ->type('body', 'Answer created')
                ->press('Post')
                ->clickLink('My Account')
                ->clickLink('Logout')
                ->assertPathIs('/')
                ->clickLink('Login')
                ->type('email', $user2->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('View')
                ->clickLink('View')
                ->assertDontSee('Edit')
                ->assertDontSee('Delete');
        });

        $question = Question::where('user_id',($user1->id))->first();
        Answer::where('question_id',($question->id))->delete();
        $question->delete();
        $user1->delete();
        $user2->delete();

    }


}
