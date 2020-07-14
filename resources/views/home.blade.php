@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            <button class="btn btn-sm btn-default border btn__ff--primary">NEW & ACTIVE ACCNT</button>
            <button class="btn btn-sm btn-default border btn__ff--primary">EXPIRED & COMPLETED ACCNT</button>
        </div>
        <div class="col-md-5">
            <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
                <form action="#" class="d-flex w-100 position-relative">
                    @csrf
                    <input class="form-control my-0 py-1" type="text" placeholder="Enter branch name or id..." aria-label="Search">
                    <button type="submit"><img src="{{ asset( 'svg/icons/search.svg' ) }}" alt="Search Icone"></button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table admin-table">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col">REF. NUMBER</th>
                            <th scope="col">FIRST NAME</th>
                            <th scope="col">LAST NAME</th>
                            <th scope="col">PAYMENT</th>
                            <th scope="col">PACKAGE</th>
                            <th scope="col">DATE OF VISITS</th>
                            <th scope="col">DATE VALID</th>
                            <th scope="col">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
@endsection
