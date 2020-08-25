<div class="col-md-4">
    <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
        <form method="POST" class="d-flex w-100 position-relative" wire:submit.prevent="submitSalonSearchField">
            @csrf
            <input
            class="form-control my-0 py-1 search__input"
            type="search" placeholder="Enter Customer Name"
            aria-label="Search Customer Name or Reference No."
            wire:model.lazy="customerOrRefNumberField"
            />
            <button type="submit" title="Click to Search Customer Name." class="cursor-pointer"><img src="{{ asset( 'svg/icons/search.svg' ) }}" alt="Search Icon"></button>
        </form>
    </div>
</div>
