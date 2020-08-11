@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center">

        @livewire('salon.salon-actions')
        {{-- Salon Actions --}}

        <div class="col-md-4">
            <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
                <form action="#" class="d-flex w-100 position-relative">
                    @csrf
                    <input class="form-control my-0 py-1 search__input" type="search" placeholder="Enter branch name or id..." aria-label="Search">
                    <button type="submit"><img src="{{ asset( 'svg/icons/search.svg' ) }}" alt="Search Icone"></button>
                </form>
            </div>
        </div>
    </div>

    @livewire('salon.salon-table')
    {{-- Salon Table --}}

</div>
@endsection
