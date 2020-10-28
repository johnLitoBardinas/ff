@extends('layouts.app')

{{-- Use for the management --}}
@section('content')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center">

        @livewire('management.management-actions')
        {{-- Management Actions --}}

        @livewire('management.management-search-field')
    </div>

    @livewire('management.management-table')
    {{-- Management Table --}}
</div>
@endsection
