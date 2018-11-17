@if (Auth::user())
    <div class="container">
        {{ Breadcrumbs::render() }}
    </div>
@endif
