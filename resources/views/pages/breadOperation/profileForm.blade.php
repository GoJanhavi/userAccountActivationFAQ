@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($edit === FALSE)
                    {!! Form::model($profile, ['route' => ['profile.store', Auth::user()->id], 'method' => 'post']) !!}
                @else()
                    {!! Form::model($profile, ['route' => ['profile.update', Auth::user()->id, $profile->id], 'method' => 'patch']) !!}
                @endif
                <div class="card">
                    <div class="card-header">My Profile</div>

                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name', $profile->fname, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name') !!}
                            {!! Form::text('last_name', $profile->lname, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'About Me') !!}
                            {!! Form::text('body', $profile->body, ['class' => 'form-control','required' => 'required']) !!}
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-right" value="submit" type="submit" id="submit">Save
                        </button>
                    </div>

                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
