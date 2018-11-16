@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Question</div>

                    <div class="card-body">
                        <p>{{$question->body}}</p>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-success float-right" href="#">
                            Edit Question
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
