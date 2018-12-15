<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class QuestionController extends Controller
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
    public function create()
    {
        $question = new Question();
        $edit = FALSE;
        return view('pages.breadOperation.questionForm', ['question'=>$question,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'body'=>'required|min:5'
        ],[
            'body.required' => 'Question text section cannot be blank',
            'body.min' => 'Question text must contain min 5 characters',
        ]);

        $input = $request->all();

        $question = new Question($input);
        $question->user()->associate(Auth::user());
        $question->save();

        return redirect()->route('home')->with('message','Question posted successfully !! ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('pages.question')->with('question',$question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if ((int)($question->user_id) == Auth::user()->id) {
            $edit = TRUE;
            return view('pages.breadOperation.questionForm', ['question' => $question, 'edit' => $edit]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question)
    {
        $input = $request->validate([
            'body'=>'required|min:5'
        ],[
            'body.required' => 'Question text section cannot be blank',
            'body.min' => 'Question text must contain min 5 characters',
        ]);

      //  $input = $request->all();
        $question->body = $request->body;

        $question->save();

        return redirect()->route('question.show',['question_id'=> $question])->with('message','Question updated successfully !! ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home')->with('message','Question deleted successfully');
    }
}
