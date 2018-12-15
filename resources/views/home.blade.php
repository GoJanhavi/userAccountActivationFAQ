@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Questions
                    <a class="btn btn-success float-right" href="{{route('question.create')}}">
                        Post New
                    </a>
                </div>

                <div class="card-body">
                    <div class="card-deck">
                        @forelse($questions as $question)
                            <div class="col-sm-4 d-flex align-items-stretch">
                                <div class="card mb-3 ">
                                    <div class="card-header">
                                        <small class="text-muted float-left">
                                            Updated: {{ $question->updated_at->diffForHumans() }}
                                        </small>
                                        <small class="float-right text-muted">
                                            Answers: {{ $question->answer()->count() }}
                                        </small>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{$question->body}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text">
                                            <small class="text-muted">Posted By: {{\App\User::find($question->user_id)->email}}</small>
                                            <a class="btn btn-primary float-right" href="{{
                                            route('question.show', ['id' => $question->id]) }}">
                                                View
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="card-text col-12">
                                There are no questions to view. Click the button above to add one
                            </p>
                        @endforelse

                    </div>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
