<div class="container mt-4 container--customer-visits">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">CUSTOMER VISITS</h3>
    <div class="row">
        <div class="col-6">
            <small>First Name</small>
            <h5>John Lito</h5>
        </div>
        <div class="col-6">
            <small>Last Name</small>
            <h5>Bardinas</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <small>Ref. Number</small>
            <h5>000000000000</h5>
        </div>
        <div class="col-6">
            <small>Payment</small>
            <h5>Paymaya</h5>
        </div>
    </div>
    <hr>
    <form action="POST" id="frm-customer-visits" novaliate>
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">
        <input type="hidden" name="customer_package_id" value="{{$encryptedCustomerPackageId}}">

        <div class="form-group d-flex customer-visits-tracker">
            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 1st Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input type="text" class="form-control" data-plugin="pikaday">
            </div>

            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 2nd Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input type="text" class="form-control" data-plugin="pikaday">
            </div>

            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 3rd Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input type="text" class="form-control" data-plugin="pikaday">
            </div>

            <div class="w-24">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 4th Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input type="text" class="form-control" data-plugin="pikaday">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>

            <a href="javascript:void(0);" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-flex" id="btn-save-new-customer">UPDATE</a>
        </div>
    </form>
</div>
