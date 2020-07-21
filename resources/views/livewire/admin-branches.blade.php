{{-- @if( $i === 0 ) text-white bg-primary @else text-dark @endif --}}
<div class="col-md-6 admin-branches">
    @forelse($branches as $branch)
        <div class="card mb-3 branch">
        <div class="card-header d-flex justify-content-between align-items-center cursor-pointer @if( $loop->index === 0 ) text-white bg-primary @else text-dark @endif"
                title="Click to Activate.">
                <span class="d-inline-block text-bold"> > </span>
                <div class="w-90 d-flex justify-content-between">
                    <div>
                    <strong class="d-block mb-0">{{ $branch->branch_name }}</strong>
                    <span class="mb-0">Branch ID:</span><br>
                    {{ strtoupper($branch->branch_code) }}
                    </div>

                    <div>
                    <p class="mb-0">Status: {{ $branch->branch_status }}</p>
                    <p class="mb-0">Date Opened: {{ date('M. d, Y', strtotime( $branch->created_at) ) }}</p>
                    </div>
                </div>

            </div>
            <div class="card-body w-90 align-self-end branch__info">
                <div class="d-flex align-items-base branch__address">
                    <span class="icon icon__location--black"></span>
                <address class="w-80">{{ $branch->branch_address }}</address>
                </div>
                <div class="d-flex branch__users">
                    <span class="icon icon__account--black"></span>

                    <div class="user_info">
                        <p class="mb-0">John Doe</p>
                        <p class="mb-0">Branch Manager</p>
                        <p class="mb-0">johndoe@gmail.com</p>
                    </div>

                    <div class="switcher w-100">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <h2>Empty Branch.</h2>
    @endforelse

</div>
