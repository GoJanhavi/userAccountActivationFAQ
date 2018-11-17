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
                        {{ Form::open(['method'  => 'DELETE', 'route' => ['question.destroy', $question->id]])}}
                        <button class="btn btn-danger float-right mr-2">
                            Delete Question
                        </button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Answers <a class="btn btn-success float-right" href="{{ route('answer.create', ['question_id'=> $question->id])}}">
                            Add Answer
                        </a></div>

                    <div class="card-body">
                        @forelse($question->answer as $answer)
                            <div class="card mb-3">
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
