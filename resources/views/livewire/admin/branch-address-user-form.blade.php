<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form'">

    @livewire('admin.admin-actions')

    <div class="mt-4">
        @livewire('components.branch-form')
    </div>

    <div class="mt-4 user-form">

        @forelse($currentBranch['user'] as $user)
            @livewire( 'components.branch-users-form', compact('user'), key($user['user_id']) )
        @empty
            <h6>No User Yet</h6>
        @endforelse

    </div>

</div>
