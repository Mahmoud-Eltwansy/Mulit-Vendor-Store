
@if(session()->has($type))
    <div class="alert alert-success">
        {{ session($type) }}
    </div>
@endif
