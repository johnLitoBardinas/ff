@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center">

        @livewire('salon.salon-actions')
        {{-- Salon Actions --}}

        @livewire('salon.salon-search-field')
    </div>

    @livewire('salon.salon-table')
    {{-- Salon Table --}}

</div>
@endsection
