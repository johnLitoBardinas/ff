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
            <div class="d-flex justify-content-between admin-action">
                <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete">
                    Delete
                </button>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none">
                        DEACTIVATE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save">
                        SAVE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser">
                        ADD USER
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit">
                        EDIT
                    </button>
                    <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit">
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

        <div class="col-md-5 vh-59 overflow-y-scroll chrome-hide-scroll">

            <div class="mt-4 address-form">
                <h6 class="text-center text-primary text-bold">
                    <span class="icon icon__location--violet mr-0 align-bottom"></span>
                    ADDRESS
                </h6>

                <form>
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Unit no./Floor no./Building
                            Name/Street</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Province/City</small>
                        <select class="custom-select border-primary">
                            <option value="1">Metro Manila - Paranaque</option>
                            <option value="1">Metro Manila - Makati</option>
                            <option value="1">Metro Manila - Pasig</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Barangay</small>
                        <select class="custom-select border-primary">
                            <option value="1">San Isidro</option>
                            <option value="1">Palanan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Region</small>
                        <select class="custom-select border-primary">
                            <option value="1">NCR</option>
                            <option value="1">REGION 5</option>
                        </select>
                    </div>

                </form>

            </div>
            {{-- Address Form Field --}}

            <div class="mt-4 user-form">
                <h6 class="text-center text-primary text-bold">
                    <span class="icon icon__account--violet mr-0 align-bottom"></span>
                    USERS
                </h6>

                <form>
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="First Name" value="John Lito">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Last Name" value="Bardinas">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="johnLito1996@gmail.com">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" value="(+63) 9123456789">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Branch</small>
                        <select class="custom-select border-primary">
                            <option value="1">Branch 1</option>
                            <option value="1">Branch 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                        <select class="custom-select border-primary">
                            <option value="1">Branch Manager</option>
                            <option value="1">Branch Cashier</option>
                        </select>
                    </div>

                </form>

            </div>
            {{-- User Form Field --}}

        </div>
    </div>
</div>
@endsection
