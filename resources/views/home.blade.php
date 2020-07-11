@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-between">
        <div class="col-md-6 flex">
            <button class="btn btn-sm btn-default border border-black">NEW & ACTIVE ACCNT</button>
            <button class="btn btn-sm btn-default border border-black">EXPIRED & COMPLETED ACCNT</button>
        </div>
        <div class="col-md-5">
            <div class="input-group md-form form-sm form-1 pl-0">
                <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-prepend">
                    <span class="input-group-text cyan lighten-2" id="basic-text1"><i
                            class="glyphicon glyphicon-search text-white" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-md-12">

            <table class="table">
                <thead class="text-white bg-primary">
                    <tr>
                        <th scope="col" class="p-1">REF. NUMBER</th>
                        <th scope="col" class="p-1">FIRST NAME</th>
                        <th scope="col" class="p-1">LAST NAME</th>
                        <th scope="col" class="p-1">PAYMENT</th>
                        <th scope="col" class="p-1">PACKAGE</th>
                        <th scope="col" class="p-1">DATE OF VISITS</th>
                        <th scope="col" class="p-1">DATE VALID</th>
                        <th scope="col" class="p-1">STATUS</th>
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
@endsection
