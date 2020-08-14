@if( session()->has('success') )
    <div>
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

@if( session()->has('error') )
    <div>
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
@endif
