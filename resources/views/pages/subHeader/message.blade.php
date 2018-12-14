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
    @if($errors->any() || session('error'))
        <div class="alert-danger alert">
            @if($errors->any())
                <ul class="m-0">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            @if (session('error'))
                <p class="m-0">{{session('message')}}</p>
            @endif

        </div>
    @endif
</div>

