@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            <button class="btn btn-default border border-dark text-center w-100 bg-light">
                <span class="float-left">+</span>
                <span>Add Branch</span>
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
    {{-- Add Branch & Search Bar --}}

    <div class="row justify-content-between align-items-center mt-4">
        <div class="col-md-6 admin-branches">
            <code>CARD BRANCH Here.</code>
        </div>

        <div class="col-md-5">
            <div class="d-flex justify-content-between admin-action">
                <button class="btn btn-sm btn-default border btn__ff--primary btn-icon__delete">
                    <img src="{{ asset( 'svg/icons/delete_icon.svg' ) }}" alt=""
                            width="15" height="15" />
                    Delete
                </button>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--save">
                        <img src="{{ asset( 'svg/icons/add_icon.svg' ) }}" alt=""
                            width="15" height="15" />
                        SAVE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--adduser">
                        <img src="{{ asset( 'svg/icons/add_icon.svg' ) }}" alt=""
                            width="15" height="15" />
                        ADD USER
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--edit">
                        <img src="{{ asset( 'svg/icons/edit_icon.svg' ) }}" alt="" width="15"
                            height="15" />
                        EDIT
                    </button>
                    <button class="btn btn-sm btn-default border btn__ff--primary btn__ff--exit">
                        <img src="{{ asset( 'svg/icons/exit_back_icon.svg' ) }}" alt="" width="15"
                            height="15" />
                        EXIT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
