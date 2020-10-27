<nav class="admin-header">
    {{-- wire:poll.750ms --}}
    <div class="container ">
        <div class="d-flex align-items-center justify-content-center py-5 admin-header__logo cursor-pointer">
            <a href="{{ $homeUrl }}" title="Click to return home.">
                <img src="{{ asset( $logo ) }}" alt="Fix and Free Salon" />
            </a>
        </div>
        {{-- Header Logo --}}
        <div class="row justify-content-between">
            <div class="col-md-4 d-flex">
                @can('access-admin')
                    <span class="d-flex align-items-baseline">
                        <a href="{{route('packages')}}" title="Click to view all the packages." class="text-dark text-decoration-none">
                            <img src="{{ asset('svg/icons/total_packages.svg') }}" alt="Packages" /> &nbsp; Packages
                        </a>
                    </span>
                @endcan

                @can('access-superadmin')
                    <span>
                        &nbsp; | &nbsp;
                        <a href="{{route('settings')}}" title="Super Admin Settings" class="text-dark text-decoration-none">
                            Super Admin Settings
                        </a>
                    </span>
                @endcan

            </div>
            <div class="col-md-4 mb-3">
                <ul class="list-unstyled d-flex justify-content-md-around p-0 m-0">
                    <li>
                       <span>
                           <img src="{{ asset('svg/icons/total_branch.svg') }}" alt="Total Branch.">
                           &nbsp; Total Branch: <b>{{$totalActiveBranchCount}}</b>
                       </span>
                    </li>
                    <li>
                        <span>
                            <img src="{{ asset('svg/icons/fix_free.management.svg') }}" alt="Total Branch.">
                            &nbsp; Salon: <b>{{$totalActiveSalonBranchCount}}</b>
                        </span>
                    </li>
                    <li>
                        <span>
                            <img src="{{ asset('svg/icons/fit_free.gym.svg') }}" alt="Total Branch.">
                            &nbsp; Gym: <b>{{$totalActiveGymBranchCount}}</b>
                        </span>
                    </li>
                    <li>
                        <span>
                            <img src="{{ asset('svg/icons/fab_free.wellness.svg') }}" alt="Total Branch.">
                            &nbsp; Spa: <b>{{$totalActiveSpaBranchCount}}</b>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 justify-content-end">
                <ul class="list-unstyled d-flex justify-content-end p-0 m-0">
                    <li>
                        <a href="{{ route( 'profile' ) }}" class="text-dark text-decoration-none">
                            {{ Auth::user()->first_name .' '.Auth::user()->last_name }}
                            <img src="{{ asset( 'svg/icons/profile.svg' ) }}" alt="Icon Profile" class="ml-2">
                        </a>
                    </li>
                    <li class="ml-5 cursor-pointer" title="CLick to logout.">

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