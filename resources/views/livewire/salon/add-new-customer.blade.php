<div class="container mt-4 container--new-customer">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD NEW CUSTOMER</h3>
    <form action="POST">
        @csrf

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary @error('firstName') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter FirstName"/>
            @error('firstName') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary @error('firstName') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter FirstName"/>
            @error('firstName') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Ref. Number</small>
            <input type="text" class="form-control border-primary @error('reference_no') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter FirstName"/>
            @error('reference_no') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Payment</small>
            <select class="custom-select border-primary">
                <option value="gcash">gcash</option>
                <option value="paymaya">paymaya</option>
                <option value="card">card</option>
            </select>
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
            <select class="custom-select border-primary">
                <option value="plan-1500">Plan 1500</option>
                <option value="plan-1800">Plan 1800</option>
                <option value="plan-2000">Plan 2000</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a
            href="javascript:void(0);"
            title="Click to Exit."
            class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">
            EXIT</a>

            <a href="javascript:void(0);"
            class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-flex"
            id="btn-savebranch">SAVE</a>
        </div>
    </form>
</div>
