<div class="container mt-4 container--new-customer">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD NEW CUSTOMER</h3>
    <form action="POST" id="frm-new-account" novaliate>
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="firstName" placeholder="Enter First Name" name="first_name" required/>
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Last Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="lastName" placeholder="Enter Last Name" name="last_name" required/>
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Ref. Number</small>
            <input type="text" class="form-control border-primary" aria-describedby="refNo" placeholder="Enter Reference Number" name="reference_no" required />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Payment</small>
            <select class="custom-select border-primary" name="payment_type" required>
                @foreach ($paymentsOptions as $option)
                    <option value="{{$option}}">{{strtoupper($option)}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Subscription Plan</small>
            <select class="custom-select border-primary" name="package_id" required>
                @forelse ($subscriptionPlans as $plan)
                    <option value="{{$plan['package_id']}}" title="{{$plan['package_description']}}">
                        {{number_format($plan['package_price'])}}</option>
                @empty
                    <option readonly disabled>No available Plan</option>
                @endforelse
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('home') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>

            <a href="javascript:void(0);" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-flex" id="btn-save-new-customer">SAVE</a>

        </div>
    </form>
</div>
