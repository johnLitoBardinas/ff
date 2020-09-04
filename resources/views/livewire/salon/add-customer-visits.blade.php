<div class="container mt-4 container--customer-visits">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD CUSTOMER VISITS</h3>
    <div class="row">
        <div class="col-6">
            <small>First Name</small>
            <h5>{{$customerPackageInfo->customer->first_name}}</h5>
        </div>
        <div class="col-6">
            <small>Last Name</small>
            <h5>{{$customerPackageInfo->customer->last_name}}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <small>Ref. Number</small>
            <h5>{{$customerPackageInfo->reference_no}}</h5>
        </div>
        <div class="col-6">
            <small>Payment</small>
            <h5>{{strtoupper($customerPackageInfo->payment_type)}}</h5>
        </div>
        <div class="col-6">
            <small>Plan</small>
            <h5>{{ucfirst($customerPackageInfo->package->package_name)}}</h5>
        </div>
        <div class="col-6">
            <small>Plan Expiration Date <strong>(60 Days)</strong></small>
            <h5>{{ date('M. d, Y', strtotime( '-1 day', strtotime( $customerPackageInfo->customer_package_end ) ) ) }}</h5>
        </div>
    </div>
    <hr>
    <form method="POST" id="frm-customer-visits" novaliate>
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::id()}}"/>
        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}"/>
        <input type="hidden" name="customer_package_id" value="{{$customerPackageInfo->customer_package_id}}"/>
        <input type="hidden" name="customer_id" value="{{$customerPackageInfo->customer_id}}">

        <div class="form-group d-flex customer-visits-tracker">
            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 1st Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input type="text" class="form-control" disabled value="{{$customerPackageFirstVisit}}"/>
            </div>

            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 2nd Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input
                type="text"
                class="form-control"
                @if( empty($customerPackageSecondVisit) ) data-plugin="pikaday" name="date" @else disabled value="{{$customerPackageSecondVisit}}" @endif
                />
            </div>

            <div class="w-24 mr-2">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 3rd Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input
                type="text"
                class="form-control"
                @if( empty($customerPackageThirdVisit) ) data-plugin="pikaday" name="date" @else disabled value="{{$customerPackageThirdVisit}}" @endif
                />
            </div>

            <div class="w-24">
                <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; 4th Visit</label>
                <small><em>(Year-Month-Day)</em></small>
                <input
                type="text"
                class="form-control"
                @if( empty($customerPackageForthVisit) ) data-plugin="pikaday" name="date" @else disabled value="{{$customerPackageForthVisit}}" @endif
                />
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>

            @if (empty($customerPackageForthVisit))
                <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-flex" id="btn-save-customer-visits">UPDATE</button>
            @else
                <span class="text-line-through">Completed Package</span>
            @endif

        </div>
    </form>
</div>
