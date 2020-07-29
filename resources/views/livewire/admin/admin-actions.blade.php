<div class="d-flex justify-content-end position-relative admin-action">
    {{-- [Admin-Actions] - {{ $action }} --}}
    <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0 d-none">
        Delete
    </button>
    <div class="d-flex justify-content-around">
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none">
            DEACTIVATE
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-none @if($action === 'addBranch') d-flex @endif">
            SAVE
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser d-none @if($action === 'readBranch') d-flex @endif" title="Add User to the Branch.">
            ADD USER
        </button>
        <button class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-none @if($action === 'readBranch') d-flex @endif" title="Edit Branch.">
            EDIT
        </button>
        <button class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none @if($action === 'addBranch') d-flex @endif">
            EXIT
        </button>
    </div>
</div>