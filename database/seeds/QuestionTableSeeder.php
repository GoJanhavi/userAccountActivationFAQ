<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::all();
        for($q=1; $q<=16; $q++) {
            $user->each(function ($user) {
                $question = factory(\App\Question::class)->make();
                $question->user()->associate($user);
                $question->save();
            });
        }
    }
}
