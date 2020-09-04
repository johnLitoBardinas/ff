<div class="container" x-data="{ activeTab: '{{$activeTab}}' }">
    {{-- {{$activeTab}} --}}
    <div class="row justify-content-between mt-4">
        <div class="col-md-4">
            <button
            class="btn btn-sm btn-default w-25 p-1 m-2"
            :class="{ 'btn--active': activeTab === 'salon' }"
            x-on:click="activeTab = 'salon'"
            wire:click="onClickTab('salon')"
            ><i>Salon</i></button>

            <button
            class="btn btn-sm btn-default w-25 p-1 m-2"
            :class="{ 'btn--active': activeTab === 'gym' }"
            x-on:click="activeTab = 'gym'"
            wire:click="onClickTab('gym')"
            ><i>Gym</i></button>

            <button
            class="btn btn-sm btn-default w-25 p-1 m-2"
            :class="{ 'btn--active': activeTab === 'spa' }"
            x-on:click="activeTab = 'spa'"
            wire:click="onClickTab('spa')"
            ><i>Spa</i></button>
        </div>

        <div class="col-md-2 d-flex justify-content-end align-items-center">
            <img src="{{ asset('svg/icons/add_icon.svg') }}" alt="Icon Add Package"> &nbsp;
            <a href="javascript:void(0);" class="text-decoration-none on-hover-primary">Add Package</a>
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

                    <tbody>
                        <tr>
                            <td>GROOM</td>
                            <td>1,800</td>
                            <td>4/60 Days</td>
                            <td>1/5 Days</td>
                            <td>1/5 Days</td>
                            <td>Sept. 10, 2020</td>
                            <td>
                               <div class="d-flex justify-content-around">
                                 <div class="switcher w-25">
                                    <label class="switch mb-0">
                                       <input type="checkbox">
                                       <span class="slider round"></span>
                                    </label>
                                 </div>

                                 <strong class="text-primary">
                                    Active
                                 </strong>

                                 <a href="javascript:void(0);"
                                 title="Edit Package."
                                 class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit">
                                 EDIT</a>

                                 <a href="javascript:void(0);"
                                 title="Delete Package."
                                 class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__delete">
                                 DELETE</a>

                               </div>

                           </td>
                        </tr>
                        <tr>
                            <td>FAB</td>
                            <td>3,000</td>
                            <td>4/60 Days</td>
                            <td>1/15 Days</td>
                            <td>1/15 Days</td>
                            <td>Sept. 10, 2020</td>
                            <td>action</td>
                        </tr>
                        <tr>
                            <td>PAMPER</td>
                            <td>5,200</td>
                            <td>4/60 Days</td>
                            <td>2/60 Days</td>
                            <td>2/60 Days</td>
                            <td>Sept. 10, 2020</td>
                            <td>action</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
