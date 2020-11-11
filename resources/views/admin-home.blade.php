@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            @livewire('admin.button-add-branch')
        </div>

        <div class="mt-4 mt-md-0 col-md-5">
            @livewire('admin.search-branch')
        </div>
    </div>

    <div class="row justify-content-between mt-4">
        @livewire('admin.admin-branches')
        @livewire('admin.branch-address-user-form')
    </div>

</div>
@endsection
