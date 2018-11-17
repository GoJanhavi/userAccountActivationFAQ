@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Question</div>

                    <div class="card-body">
                        <p>{{$question->body}}</p>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-success float-right" href="{{ route('question.edit', ['question_id' => $question->id]) }}">
                            Edit Question
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><a class="btn btn-success" href="#">
                            Add Answer
                        </a></div>

                    <div class="card-body">
                        @forelse($question->answer as $answer)
                            <div class="card">
                                <div class="card-body">{{$answer->body}}</div>
                                <div class="card-footer">

                                    <a class="btn btn-primary float-right"
                                       href="{{ route('answer.show', ['question_id'=> $question->id,'answer_id' => $answer->id]) }}">
                                        View
                                    </a>

                                </div>
                            </div>
                        @empty
                            <div class="card">

                                <div class="card-body"> No Answers</div>
                            </div>
                        @endforelse

                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
