<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question)
    {
        $answer = new Answer;
        $edit = FALSE;
        return view('pages.breadOperation.answerForm', ['answer' => $answer,'edit' => $edit, 'question' =>$question  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $question)
    {
        $input = $request->validate([
            'body'=>'required|min:5'
        ],[
            'body.required' => 'Answer text section cannot be blank',
            'body.min' => 'Answer text must contain min 5 characters',
        ]);

        $input = request()->all();
        $question = Question::find($question);
        $Answer = new Answer($input);
        $Answer->user()->associate(Auth::user());
        $Answer->question()->associate($question);
        $Answer->save();
        return redirect()->route('question.show',['question_id' => $question->id])->with('message', 'Question answered successfully !! ');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($question, $answer)
    {
        $answer=Answer::find($answer);
        return view('pages.answer')->with(['answer'=> $answer, 'question'=>$question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question, $answer)
    {
        $answer = Answer::find($answer); //gets answer object
        $edit = TRUE;
        return view('pages.breadOperation.answerForm',['answer'=> $answer,'question'=>$question,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question, $answer)
    {
        $input = $request->validate([
            'body'=>'required|min:5'
        ],[
            'body.required' => 'Answer text section cannot be blank',
            'body.min' => 'Answer text must contain min 5 characters',
        ]);

        $answer = Answer::find($answer);
        $answer->body = $request->body;
        $answer->save();
        return redirect()->route('answer.show',['question_id' => $question, 'answer_id' => $answer])->with('message', 'Answer successfully updated !!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
