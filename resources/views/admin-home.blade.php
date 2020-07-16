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
                <button class="btn btn-sm btn-default border btn__ff--primary btn-icon__delete">
                    <img src="{{ asset( 'svg/icons/delete_icon.svg' ) }}" alt="" width="15"
                        height="15" />
                    Delete
                </button>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--save">
                        <img src="{{ asset( 'svg/icons/add_icon.svg' ) }}" alt="" width="15"
                            height="15" />
                        SAVE
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--adduser">
                        <img src="{{ asset( 'svg/icons/add_icon.svg' ) }}" alt="" width="15"
                            height="15" />
                        ADD USER
                    </button>
                    <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn__ff--edit">
                        <img src="{{ asset( 'svg/icons/edit_icon.svg' ) }}" alt="" width="15"
                            height="15" />
                        EDIT
                    </button>
                    <button class="btn btn-sm btn-default border btn__ff--primary btn__ff--exit">
                        <img src="{{ asset( 'svg/icons/exit_back_icon.svg' ) }}" alt=""
                            width="15" height="15" />
                        EXIT
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-6 admin-branches">
            @for($i = 0; $i < 5; $i++)
                <div class="card mb-3 branch">
                    <div class="card-header d-flex justify-content-between align-items-center cursor-pointer @if( $i === 0 ) text-white bg-primary @else text-dark @endif"
                        title="Click to Activate.">
                        <span class="d-inline-block text-bold"> > </span>
                        <div class="w-90 d-flex justify-content-between">
                            <div>
                                <strong class="d-block mb-0">Caniogan, Pasig</strong>
                                <span class="mb-0">Branch ID: 000000000</span>
                            </div>

                            <div>
                                <p class="mb-0">Status: Active</p>
                                <p class="mb-0">Date Opened: 9/1/2020</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body w-90 align-self-end branch__info">
                        <div class="d-flex align-items-base branch__address">
                            <img src="{{ asset('svg/icons/branch_location_icon.svg') }}"
                                alt="Branch Location Icon" width="20" height="20" />
                            <address class="w-80">213 Gemini St. Rainbow Village 2, UPS 5, Sucat Rd. San Isidro, Metro
                                Manila - Paranaque
                                City 1700, NCR</address>
                        </div>
                        <div class="d-flex branch__users">
                            <img src="{{ asset('svg/icons/branch_user_icon.svg') }}"
                                alt="Branch User Icon" width="20" height="20" />

                            <div class="user_info">
                                <p class="mb-0">John Doe</p>
                                <p class="mb-0">Branch Manager</p>
                                <p class="mb-0">johndoe@gmail.com</p>
                            </div>

                            <div class="switcher">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            @endfor
        </div>
        {{-- Branch List --}}

        <div class="col-md-5 vh-59 overflow-y-scroll chrome-hide-scroll">

            <div class="mt-4 address-form">
                <h6 class="text-center text-primary text-bold">
                    <img src="{{ asset( 'svg/icons/branch_location_icon.svg' ) }}"
                        alt="Branch Location Icon" width="20" height="20">
                    ADDRESS
                </h6>

                <form >
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Unit no./Floor no./Building Name/Street</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
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
                    <img src="{{ asset( 'svg/icons/branch_user_icon.svg' ) }}"
                        alt="Branch Location Icon" width="20" height="20">
                    USERS
                </h6>

                <form >
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="First Name" value="John Lito">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Last Name" value="Bardinas">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" value="johnLito1996@gmail.com">
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" value="(+63) 9123456789">
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

        </div>
    </div>
</div>
@endsection
