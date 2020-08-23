<div class="col-md-4">
    <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
        {{-- {{ $customerOrRefNumberField }} --}}
        <form action="#" class="d-flex w-100 position-relative">
            @csrf
            <input
            class="form-control my-0 py-1 search__input"
            type="search" placeholder="Enter Customer Name"
            aria-label="Search Customer Name or Reference No."
            wire:model.debounce.500ms="customerOrRefNumberField"
            />
            <button type="submit"><img src="{{ asset( 'svg/icons/search.svg' ) }}" alt="Search Icone"></button>
        </form>
    </div>
</div>
