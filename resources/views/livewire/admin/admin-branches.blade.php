<div class="col-md-6 admin-branches">
    @forelse($branches as $branch)
        @livewire('admin.branch-card', ['branch' => $branch, 'branchId' => $activeBranchId], key($branch->branch_id))
    @empty
        <h2>Empty Branch.</h2>
    @endforelse
</div>
