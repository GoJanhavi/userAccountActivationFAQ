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

Breadcrumbs::for('profile.create', function ($trail, $user_id ) {
    $trail->parent('home');
    $trail->push('Create Profile', route('profile.create', ['user_id'=>$user_id]));
});

Breadcrumbs::for('profile.edit', function ($trail, $user_id ,$profile_id) {
    $trail->parent('profile.show',$user_id ,$profile_id );
    $trail->push('Edit Profile', route('profile.edit', ['user_id'=>$user_id, 'profile_id'=>$profile_id]));
});



// Question
Breadcrumbs::for('question.show', function ($trail, $question) {
    $trail->parent('home');
    $trail->push('Question', route('question.show',['question'=>$question]));
});

Breadcrumbs::for('question.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Add Question', route('question.create'));
});





// Answer
Breadcrumbs::for('answer.show', function ($trail,$question, $answer_id ) {
    $trail->parent('question.show',$question);

    $trail->push('Answer', route('answer.show', ['question_id'=> $question, 'answer_id'=>$answer_id]));

});

