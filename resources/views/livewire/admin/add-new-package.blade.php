<div class="container mt-5 container--new-package">
    <h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD PACKAGE</h3>
    {{-- {{$type}} --}}
    <form method="POST" id="frm-new-package" novaliate>
        @csrf
        <input type="hidden" name="branch_type" value="{{$type}}">
        <div class="form-group">
            <small for="package_name" class="form-text text-muted">Package Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="packageName" placeholder="Package Name" name="package_name" required/>
        </div>

        <div class="form-group">
            <small for="package_price" class="form-text text-muted">Price</small>
            <input type="number" class="form-control border-primary" aria-describedby="packagePrice" placeholder="Amount" name="package_price" min="1500" required/>
        </div>

        <div class="form-group d-flex mb-3">
            <div class="w-33 mr-2">
                <div class="border text-center bg-primary text-white py-1 px-3 mb-2">
                    @if( $type === 'salon') PAID SALON @else FREE SALON @endif
                </div>
                <small>No. of Visits</small>
                <input type="number" class="form-control" required min="1" max="4"/>
            </div>

            <div class="w-33 mr-2">
                <div class="border text-center bg-primary text-white py-1 px-3 mb-2">
                    @if( $type === 'gym') PAID GYM @else FREE GYM @endif
                </div>
                @if($type !== 'gym')
                    <small>No. of Visits</small>
                    <input type="number" class="form-control" required min="1" max="4"/>
                @endif
            </div>

            <div class="w-33">
                <div class="border text-center bg-primary text-white py-1 px-3 mb-2">
                    @if( $type === 'spa') PAID SPA @else FREE SPA @endif
                </div>
                <small>No. of Visits</small>
                <input type="number" class="form-control" required min="1" max="4"/>
            </div>
        </div>

        <div class="form-group d-flex">
            <div class="w-33 mr-2">
                <small>Days Valid</small>
                <input type="number" class="form-control" required min="5" max="60"/>
            </div>

            <div class="w-33 mr-2">
                <small>Days Valid</small>
                <input type="number" class="form-control" required min="5" max="60"/>
            </div>

            <div class="w-33">
                <small>Days Valid</small>
                <input type="number" class="form-control" required min="5" max="60"/>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between">
        <a href="{{ route('packages') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-flex" id="btn-save-package">SAVE</button>
    </div>
</div>
