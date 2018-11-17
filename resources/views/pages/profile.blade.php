@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <div class="row"> <label class="col-2 font-weight-bold">First Name: </label> <span class="col-10">{{$profile->first_name}}</span></div>
                        <div class="row"><label class="col-2 font-weight-bold">Last Name: </label> <span class="col-10">{{$profile->last_name}}</span></div>
                        <div class="row"><label class="col-2 font-weight-bold">About: </label> <span class="col-10">{{$profile->body}}</span></div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-success float-right" href="{{ route('profile.edit', ['profile_id' => $profile->id,'user_id' => $profile->user->id]) }}">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
