@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Question
                        <small class="text-muted float-right">
                            Updated: {{ $question->updated_at->diffForHumans() }}
                        </small>
                    </div>

                    <div class="card-body">
                        <p>{{$question->body}}</p>
                    </div>

                    <div class="card-footer">
                        <small class="text-muted float-left">Posted By: {{\App\User::find($question->user_id)->email}}</small>
                        @if(Auth::user()->id ==$question->user_id)
                            <a class="btn btn-success float-right" href="{{ route('question.edit', ['question_id' => $question->id]) }}">
                                Edit
                            </a>
                            {{ Form::open(['method'  => 'DELETE', 'route' => ['question.destroy', $question->id]])}}
                            <button class="btn btn-danger float-right mr-2">
                                Delete
                            </button>
                            {{Form::close()}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Answers <a class="btn btn-success float-right" href="{{ route('answer.create', ['question_id'=> $question->id])}}">
                            Post New
                        </a></div>

                    <div class="card-body">
                        @forelse($question->answer as $answer)
                            <div class="card mb-3">
                                <div class="card-body">{{$answer->body}}</div>
                                <div class="card-footer">
                                    <small class="text-muted">Posted By: {{\App\User::find($answer->user_id)->email}}
                                       &nbsp;| Updated: {{ $answer->updated_at->diffForHumans() }}
                                    </small>
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
