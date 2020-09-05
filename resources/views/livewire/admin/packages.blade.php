<div class="container" x-data="{ activeTab: '{{$activeTab}}' }" x-init="activeTab = '{{$activeTab}}'">
    {{-- <span>LV: {{$activeTab}}</span> --}}
    {{-- ALP: <span x-text="activeTab"></span> --}}
    <div class="row justify-content-between mt-4">
        <div class="col-md-4">
            <button
            class="btn btn-sm btn-default w-25 p-1 m-2 cursor-pointer"
            :class="{ 'btn--active': activeTab === 'salon' }"
            x-on:click="activeTab = 'salon'"
            wire:click="onClickTab('salon')"
            ><i>Salon</i></button>

            <button
            class="btn btn-sm btn-default w-25 p-1 m-2 cursor-pointer"
            :class="{ 'btn--active': activeTab === 'gym' }"
            x-on:click="activeTab = 'gym'"
            wire:click="onClickTab('gym')"
            ><i>Gym</i></button>

            <button
            class="btn btn-sm btn-default w-25 p-1 m-2 cursor-pointer"
            :class="{ 'btn--active': activeTab === 'spa' }"
            x-on:click="activeTab = 'spa'"
            wire:click="onClickTab('spa')"
            ><i>Spa</i></button>
        </div>

        <div class="col-md-2 d-flex justify-content-end align-items-center">
            <img src="{{ asset('svg/icons/add_icon.svg') }}" alt="Icon Add Package"> &nbsp;
            <button
            onclick="window.location.href='{{route('add-package', $activeTab)}}'"
            :disabled="activeTab !== '{{$activeTab}}'"
            class="text-decoration-none on-hover-primary bg-none border-0"
            title="Click here to add Package"
            >Add Package</button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover admin-table">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col">
                                PACKAGE NAME
                            </th>
                            <th scope="col">
                                PRICE
                            </th>
                            <th scope="col">
                                SALON
                            </th>
                            <th scope="col">
                                GYM
                            </th>
                            <th scope="col">
                                SPA
                            </th>
                            <th scope="col">
                                DATE CREATED
                            </th>
                            <th scope="col" width="25%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody wire:loading wire:target="onClickTab">
                        <tr>
                            <td colspan="7">Loading..</td>
                        </tr>
                    </tbody>
                    <tbody wire:loading.remove wire:target="onClickTab">
                        @forelse ($packageList as $package)
                        <tr>
                            <td>{{strtoupper($package['package_name'])}}</td>
                            <td>{{number_format($package['package_price'])}}</td>
                            <td>{{sprintf('%s/%s Days', $package['salon_no_of_visits'], $package['salon_days_valid_count'])}}</td>
                            @if ($package['package_type'] !== 'gym')
                            <td>{{sprintf('%s/%s Days', $package['gym_no_of_visits'], $package['gym_days_valid_count'])}}</td>
                            @else
                            <td>{{sprintf('%s Days', $package['gym_days_valid_count'])}}</td>
                            @endif
                            <td>{{sprintf('%s/%s Days', $package['spa_no_of_visits'], $package['spa_days_valid_count'])}}</td>
                            <td>
                                {{date('M. d, Y', strtotime( $package['created_at'] ) )}}
                            </td>
                            <td>
                               <div class="d-flex justify-content-around" x-data="{
                                   packageId: '{{$package['package_id']}}',
                                   packageStatus: '{{$package['package_status']}}',
                                }
                                ">
                                 <div class="switcher w-25">
                                    <label class="switch mb-0">
                                       <input type="checkbox"
                                       wire:click="togglePackageStatus({{ $package['package_id'] }})"
                                       x-on:click="packageStatus = (packageStatus === 'active' ? 'inactive' : 'active')"
                                       :checked="packageStatus === 'active'">
                                       <span class="slider round"></span>
                                    </label>
                                 </div>

                                 <strong class="text-primary uc-first" x-text="packageStatus"></strong>

                                 <a href="javascript:void(0);"
                                 title="Delete Package."
                                 class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__delete">
                                 DELETE</a>

                               </div>

                           </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Package.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
