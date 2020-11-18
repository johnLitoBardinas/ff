<div class="container mt-5 container--new-package">
<h3 class="text-uppercase text-white bg-primary text-center font-weight-light">ADD {{$type}} PACKAGE </h3>
    <form method="POST" id="frm-new-package" novaliate>
        @csrf
        <input type="hidden" name="package_type" value="{{$type}}">
        <div class="form-group">
            <small for="package_name" class="form-text text-muted">Package Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="packageName" placeholder="Package Name" name="package_name" required/>
        </div>

        <div class="form-group">
            <small for="package_price" class="form-text text-muted">Price</small>
            <input type="number" class="form-control border-primary" aria-describedby="packagePrice" placeholder="Amount" name="package_price" min="0" required/>
        </div>

        <div class="form-group d-flex mb-3">
            @forelse ($defaultPackageType as $service)
                <div class="w-33 mr-2">
                    <div class="border text-center bg-primary text-white py-1 px-3 mb-2">
                        @if( $type === $service) {{ sprintf('PAID %s', strtoupper($service)) }} @else {{ sprintf('FREE %s', strtoupper($service)) }} @endif
                    </div>
                    @if ($service === 'gym' && $type === 'gym')
                        <input type="hidden" class="form-control" name="{{ sprintf('%s_no_of_visits', $service)}}" value="0" />
                    @else
                        <small>No. of Visits</small>
                        <input type="number" class="form-control" name="{{ sprintf('%s_no_of_visits', $service)}}" @if ($type === $service) min="1" max="4" @else min="0" max="4" @endif required />
                    @endif
                </div>
            @empty
                <h3>No Available Services</h3>
            @endforelse
        </div>
        {{-- Number of Visits. --}}

        <div class="form-group d-flex">
            @forelse ($defaultPackageType as $service)
                <div class="w-33 mr-2">
                    <small>Days Valid</small>
                <input type="number" class="form-control" name="{{ sprintf('%s_days_valid_count' ,$service) }}" @if ($type === $service) min="1" max="365" @else min="0" max="365" @endif required/>
                </div>
            @empty
                <h3>No Available Services</h3>
            @endforelse
        </div>
        {{-- Service No. of Days Service Valid --}}

    </form>
    <div class="d-flex justify-content-between">
        <a href="{{ route('packages') }}" title="Click to Exit." class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-flex">EXIT</a>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-flex" id="btn-save-package">SAVE</button>
    </div>
</div>
