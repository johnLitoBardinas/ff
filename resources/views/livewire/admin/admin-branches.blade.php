<div class="col-md-6 admin-branches" x-data="adminBranches">
{{-- Current Branch ID: {{ $activeBranchId }} --}}
{{-- LV Branch Search - {{$currentBranchSearch}} --}}
    @forelse($branches as $branch)
        <div class="card mb-3 branch" >
            <div class="card-header d-flex justify-content-between align-items-center cursor-pointer"
                x-bind:class="[ {{ $branch->branch_id }} === {{$activeBranchId}} ? 'text-white bg-primary' : 'text-dark']"
                title="Click to Activate." wire:click="changeBranch({{$branch->branch_id}})">
                <span class="d-inline-block text-bold"> > </span>
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
            <div class="card-body w-90 align-self-end branch__info">
                <div class="d-flex align-items-base branch__address">
                    <span class="icon icon__location--black"></span>
                    <address class="w-80">{{ $branch->branch_address }}</address>
                </div>
                @forelse($branch->user as $user)
                    <div class="d-flex branch__users" x-data="{ userStatus: '{{ $user->user_status }}' }"
                        :class="{ 'opacity-point5' : userStatus === 'inactive' }">
                        <span class="icon icon__account--black"></span>

                        <div class="user_info w-75">
                            <p class="mb-0"><b>Name:</b>
                                {{ sprintf('%s %s', $user->first_name, $user->last_name) }}
                            </p>
                            <p class="mb-0"><b>Type:</b> {{ $user->role->name }}</p>
                            <p class="mb-0"><b>Email:</b> {{ $user->email }}</p>
                        </div>

                        <div class="switcher">
                            <label class="switch">
                                <input type="checkbox" wire:click="toggleUserStatus({{ $user->user_id }})"
                                    x-bind:checked="userStatus === 'active'">
                                <span class="slider round"></span>
                            </label>
                        </div>

                    </div>
                    <br>
                @empty
                    <h6>No User yet..</h6>
                @endforelse

            </div>
        </div>
    @empty
        <h2>Empty Branch.</h2>
    @endforelse
</div>

<script>
    function adminBranches() {
        return {

        };
    }
</script>