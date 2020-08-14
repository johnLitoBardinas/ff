@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-between">
        <div class="col-md-6">
            @livewire('profile-form')
        </div>

        <div class="col-md-5">
            @livewire('change-password-form')
        </div>
    </div>

</div>
@endsection
