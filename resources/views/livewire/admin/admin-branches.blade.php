<div class="col-md-6 admin-branches" x-data="adminBranches">
    @forelse($branches as $branch)
        <div class="card mb-3 branch" >
            <div class="card-header d-flex justify-content-between align-items-center cursor-pointer"
                x-bind:class="[ {{ $branch->branch_id }} === {{$activeBranchId}} ? 'text-white bg-primary' : 'text-dark']"
                title="Click to Activate." wire:click="changeBranch({{$branch->branch_id}})">
                <span class="d-inline-block text-bold"> &#62;</span>

                <div class="w-10 d-flex">
                <x-icon type="{{$branch->branch_type}}" active="{{ $branch->branch_id === $activeBranchId }}"/>
                </div>

                <div class="w-90 d-flex justify-content-between">
                    <div>
                        <strong class="d-block mb-0">{{ $branch->branch_name }}</strong>
                        <span class="mb-0">Branch ID: {{ strtoupper($branch->branch_code) }}</span>
                    </div>

                    <div>
                        <p class="mb-0">Status: {{ $branch->branch_status }}</p>
                        <p class="mb-0">Date Opened:
                            {{ date('M. d, Y', strtotime( $branch->created_at) ) }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- ./card-header --}}
            <div class="card-body w-90 align-self-end branch__info">
                Card Body
            </div>
            {{-- ./ card-body --}}
        </div>
    @empty
        <h2>Empty Branch...</h2>
    @endforelse
</div>

<script>
    function adminBranches() {
        return {

        };
    }
</script>