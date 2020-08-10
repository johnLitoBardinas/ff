<nav class="admin-header">
    <div class="container ">
    <div class="d-flex align-items-center justify-content-center py-5 admin-header__logo cursor-pointer">
        <a href="{{ $homeUrl }}" title="Click to return home.">
            <img src="{{ asset( $logo ) }}" alt="Fix and Free Salon" />
        </a>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3">
                <span class="d-flex align-items-baseline">
                <a href="{{ $homeUrl }}" title="Home">
                    <img src="{{ asset('svg/icons/store.svg') }}" alt="Icon Total Branch" class="mr-2 mb-3" style="vertical-align: top;"/>
                </a>
                Total Active Branch: &nbsp; <b> {{ $totalBranch  }} </b>
                </span>
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled d-flex justify-content-end p-0 m-0">
                    <li>
                        <a href="{{ route( 'profile' ) }}">
                            {{ Auth::user()->first_name .' '.Auth::user()->last_name }}
                            <img src="{{ asset( 'svg/icons/profile.svg' ) }}" alt="Icon Profile" class="ml-2">
                        </a>
                    </li>
                    <li class="ml-5 ">

                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <img src="{{ asset( 'svg/icons/logout.svg' ) }}" alt="Logout Image">
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}"
                            method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>