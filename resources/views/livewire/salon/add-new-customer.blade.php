<div class="container mt-4 container--new-customer">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD NEW CUSTOMER</h3>
    <form action="POST" id="frm-new-account">
        @csrf

        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="firstName" placeholder="Enter First Name" required/>
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Last Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="lastName" placeholder="Enter Last Name" />
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Ref. Number</small>
            <input type="text" class="form-control border-primary @error('reference_no') is-invalid @enderror" aria-describedby="refNo" placeholder="Enter Reference Number" />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Payment</small>
            <select class="custom-select border-primary">
                @foreach ($payments as $option)
                    <option value="{{$option}}">{{strtoupper($option)}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Subscription Plan</small>
            <select class="custom-select border-primary">
                <option value="plan-1500">Plan 1500</option>
                <option value="plan-1800">Plan 1800</option>
                <option value="plan-2000">Plan 2000</option>
            </select>
        </div>

        <div class="form-group d-flex customer-visits-tracker">
            <div class="w-24 mr-2">
                <small for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1">&nbsp; 1st Visit</small>
                <input type="text" class="form-control">
                <input type="file">
            </div>

            <div class="w-24 mr-2">
                <small for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1">&nbsp; 2nd Visit</small>
                <input type="text" class="form-control">
                <input type="file">
            </div>

            <div class="w-24 mr-2">
                <small for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1">&nbsp; 3rd Visit</small>
                <input type="text" class="form-control">
                <input type="file">
            </div>

            <div class="w-24">
                <small for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1">&nbsp; 4th Visit</small>
                <input type="text" class="form-control">
                <input type="file">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">
            EXIT</a>

            <a href="javascript:void(0);" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-flex" id="btn-save-new-customer">SAVE</a>
        </div>
    </form>
</div>

{{--
    11:23 08-12-2020

    * Implement this feature using the following methods
        0. Ready the Data with Validation (PickAAday + Dropzone + Parsley)
        1. Create a API Endpoint


--}}