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
            <small>Payment via</small>
            <h5>{{strtoupper($customerPackageInfo->payment_type)}}</h5>
        </div>
        <div class="col-6">
            <small>Subscription Plan</small>
            <h5>{{strtoupper($customerPackageInfo->package->package_name)}} <em>({{$customerPackageType}})</em></h5>
        </div>
        <div class="col-6">
            <small>Valid Until</small>
            <h5>{{ date('M. d, Y', strtotime( '-1 day', strtotime( $customerPackageEndDate ) ) ) }}</h5>
        </div>
    </div>
    <hr>
    <form method="POST" id="frm-customer-visits" novaliate>
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::id()}}"/>
        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}"/>
        <input type="hidden" name="customer_package_id" value="{{$customerPackageInfo->customer_package_id}}"/>
        <input type="hidden" name="package_type" value="{{$customerPackageType}}">
        <input type="hidden" name="customer_id" value="{{$customerPackageInfo->customer_id}}">

        <div class="form-group d-flex customer-visits-tracker">
            @for ($i = 0; $i < $packageTotalCount; $i++)
                <div class="w-auto mr-1">
                    <label for="exampleInputEmail1" class="form-text font-weight-bold text-dark pb-1 mb-0">&nbsp; {{ strtoupper(sprintf( '%s visit', ($i + 1) ))}}</label>
                    <small><em>(Year-Month-Day)</em></small>
                    <input type="text" class="form-control"
                    @if (empty($customerPackageVisitation[$i]))
                    data-plugin="pikaday" name="date"
                    @else
                    disabled value="{{date('Y-m-d', strtotime($customerPackageVisitation[$i]['date']))}}"
                    @endif
                    />
                </div>
            @endfor
        </div>
    </form>
    <div class="d-flex justify-content-between">
        <a href="{{ route('home') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>

        @if (count($customerPackageVisitation) === $packageTotalCount)
            <span class="text-line-through">Completed Service</span>
        @else
            <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-flex" id="btn-save-customer-visits">ADD VISITS</button>
        @endif

    </div>
</div>
