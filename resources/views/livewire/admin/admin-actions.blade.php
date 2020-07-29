<div class="d-flex justify-content-end position-relative admin-action">
    {{-- [Admin-Actions] - {{ $action }} --}}
    <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0 d-none" wire:click="deleteBranch({{ $currentBranchId }})">
        Delete
    </button>
    <div class="d-flex justify-content-around">
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none" wire:click="deactivateBranch({{ $currentBranchId }})">
            DEACTIVATE
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-none @if($action === 'addBranch') d-flex @endif" wire:click="saveBranch({{ $currentBranchId }})">
            SAVE
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser d-none @if($action === 'readBranch' || $action === 'addBranch') d-flex @endif" title="Add User to the Branch." wire:click="addBranchUser({{ $currentBranchId }})">
            ADD USER
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-none @if($action === 'readBranch') d-flex @endif" title="Edit Branch." wire:click="editBranch({{$currentBranchId}})">
            EDIT
        </button>
        <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none @if($action === 'addBranch') d-flex @endif" wire:click="$emit('Action', 'readBranch')">
            EXIT
        </button>
    </div>
</div>