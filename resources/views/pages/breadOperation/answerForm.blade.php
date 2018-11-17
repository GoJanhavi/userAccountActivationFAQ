@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($edit === FALSE)
                    {!! Form::model($answer, ['route' => ['answer.store', $question], 'method' => 'post']) !!}

                @else()
                    {!! Form::model($answer, ['route' => ['answer.update', $question, $answer], 'method' => 'patch']) !!}
                @endif
                <div class="card">
                    <div class="card-header">New Question</div>

                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('body', 'Write your Answer below:') !!}
                            {!! Form::textarea('body', $answer->body, ['class' => 'form-control','required' => 'required']) !!}
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-right" value="submit" type="submit" id="submit">Post
                        </button>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
