@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            <button class="btn btn-default border border-dark text-center w-100 bg-light">
                <span class="float-left">+</span>
                <span class="text-bold font-15px">Add Branch</span>
            </button>
        </div>

        <div class="col-md-5">
            @livewire('admin.search-branch')
        </div>
    </div>

    <div class="row justify-content-between mt-4">
        @livewire('admin.admin-branches')
        @livewire('admin.branch-address-user-form')
    </div>

</div>
@endsection
