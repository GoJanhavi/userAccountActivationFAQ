<div class="container">
    @if(session()->has('message') || session('status'))
    <div class="alert-success alert">
        @if(session()->has('message'))
            <p class="m-0">{{session()->get('message')}}</p>
        @endif
        @if(session('status'))
            <p class="m-0">{{session('message')}}</p>
        @endif
    </div>
    @endif
    @if($errors->any())
        <div class="alert-danger alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

