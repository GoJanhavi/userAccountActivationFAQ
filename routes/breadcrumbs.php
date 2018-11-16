<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Profile
Breadcrumbs::for('profile.show', function ($trail, $user_id,$profile_id ) {
    $trail->parent('home');
    $trail->push('Profile', route('profile.show', ['user_id'=>$user_id, 'profile_id'=>$profile_id]));
});

// Question
Breadcrumbs::for('question.show', function ($trail, $question) {
    $trail->parent('home');
    $trail->push('Question', route('question.show',['question'=>$question]));
});


// Answer
Breadcrumbs::for('answer.show', function ($trail,$question, $answer_id ) {
    $trail->parent('question.show',$question);

    $trail->push('Answer', route('answer.show', ['question_id'=> $question, 'answer_id'=>$answer_id]));

});

