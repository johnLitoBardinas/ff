<div class="input-group md-form form-sm form-1 pl-0 d-flex justify-content-end admin-searchbar">
    <form action="#" class="d-flex w-100 position-relative">
        @csrf
        <input class="form-control my-0 py-1 search__input" type="search"
            placeholder="Enter branch name or id..." aria-label="Search">
        <button type="submit"><img src="{{ asset( 'svg/icons/search.svg' ) }}"
                alt="Search Icone"></button>
    </form>
</div>