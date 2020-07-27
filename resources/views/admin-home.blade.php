@extends('layouts.app')

@section('content')

<div class="container mt-4" x-data="{ action: 'readBranch' }">

    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            <button x-on:click="action = 'addBranch'" class="btn btn-default border border-dark text-center w-100 bg-light">
                <span class="float-left">+</span>
                <span class="text-bold font-15px">Add Branch</span>
            </button>
        </div>

        <div class="col-md-5">
            <div class="input-group md-form form-sm form-1 pl-0 d-flex justify-content-end admin-searchbar">
                <form action="#" class="d-flex w-100 position-relative">
                    @csrf
                    <input class="form-control my-0 py-1 search__input" type="search"
                        placeholder="Enter branch name or id..." aria-label="Search">
                    <button type="submit"><img src="{{ asset( 'svg/icons/search.svg' ) }}"
                            alt="Search Icone"></button>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Branch & Search Branch --}}

    <div class="row justify-content-end mt-4">
        <div class="col-md-5">
            <div class="d-flex justify-content-end position-relative admin-action">
                <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0" x-show="action === 'editBranch'">
                    Delete
                </button>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none" >
                        DEACTIVATE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save" x-show="action === 'addBranch'">
                        SAVE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser" title="Add User to the Branch.">
                        ADD USER
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit" x-bind:class="{ 'd-none' : action !== 'readBranch'}" title="Edit Branch.">
                        EDIT
                    </button>
                    <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit" x-bind:class="{ 'd-none' : action === 'readBranch'}" x-on:click="action = 'readBranch'">
                        EXIT
                    </button>
                </div>
            </div>
        </div>
        {{-- Button Interaction --}}
    </div>

    <div class="row justify-content-between">

        @livewire('admin-branches')
        {{-- Branch List --}}

        <template x-if="action === 'addBranch'">
            @livewire('form-add-branch')
        </template>

        <template x-if="action === 'readBranch'">
        @livewire('branch-address-user-form')
        {{-- Branch Form (Address & Users) --}}
        </template>
    </div>
</div>
@endsection
