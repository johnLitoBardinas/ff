<div class="row mt-4">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead class="text-white bg-primary">
                    <tr>
                        <th scope="col">
                            REF. NUMBER
                        </th>
                        <th scope="col">
                            NAME
                        </th>
                        <th scope="col">
                            PAYMENT
                        </th>
                        <th scope="col">
                            PACKAGE
                        </th>
                        <th scope="col">
                            TYPE
                        </th>
                        <th scope="col">
                            PRICE
                        </th>
                        <th scope="col">
                            DATE OF VISITS
                            <small><em>(Month-Day-Year)</em></small>
                        </th>
                        <th scope="col">
                            DATE VALID
                        </th>
                        <th scope="col">
                            STATUS
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customerPackageVisitsInfo as $row)
                        <tr>
                            <td>{{strtoupper($row->reference_no)}}</td>
                            <td>{{ucwords($row->customer->first_name). ' ' .ucwords($row->customer->last_name)}}</td>
                            <td>{{strtoupper($row->payment_type)}}</td>
                            <td>{{strtoupper($row->package->package_name)}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if (session('userAccessType') === 'salon')
                                        <h6 class="mt-2">{{ucfirst(session('userAccessType'))}}</h6>
                                        <h6 class="mt-2">Gym</h6>
                                        <h6 class="mt-2">Spa</h6>
                                    @elseif(session('userAccessType') === 'gym')
                                        <h6 class="mt-2">{{ucfirst(session('userAccessType'))}}</h6>
                                        <h6 class="mt-2">Salon</h6>
                                        <h6 class="mt-2">Spa</h6>
                                    @elseif(session('userAccessType') === 'spa')
                                        <h6 class="mt-2">{{ucfirst(session('userAccessType'))}}</h6>
                                        <h6 class="mt-2">Salon</h6>
                                        <h6 class="mt-2">Gym</h6>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <h6 class="mt-2">{{number_format($row->package->package_price)}}</h6>
                                    <h6 class="mt-2 text-line-through">Free</h6>
                                    <h6 class="mt-2 text-line-through">Free</h6>
                                </div>
                            </td>
                            <td>

                                {{-- Paid Package Plan --}}
                                <div class="w-100 d-flex justify-content-start">
                                    @for ($i = 0; $i < $row->package->salon_no_of_visits; $i++)
                                        <div class="w-auto d-flex flex-column mr-1">
                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                {{-- {{date('n-j-Y', strtotime($customerVisits[$i]['date']))}} --}}
                                                {{date('n-j-Y', strtotime(now()))}}
                                            </button>
                                        </div>
                                    @endfor
                                </div>

                                {{-- Freebies Package --}}
                                <div class="w-100 justify-content-start mt-2 check">
                                    Test 2
                                </div>

                                {{-- Freebies Package --}}
                                <div class="w-100 justify-content-start mt-2 check">
                                    Test 3
                                </div>

                            </td>
                            <td>
                                <?php $packageRowType = session('userAccessType') . '_package_end'; ?>

                                <div class="d-flex flex-column">
                                    <h6 class="mt-2">{{date('M. d, Y', strtotime($row->$packageRowType))}}</h6>
                                    <h6 class="mt-2">{{date('M. d, Y', strtotime($row->$packageRowType))}}</h6>
                                    <h6 class="mt-2">{{date('M. d, Y', strtotime($row->$packageRowType))}}</h6>
                                </div>

                            </td>
                            <td>
                                {{-- <span class="package-status package-status--active">{{ strtoupper($row->customer_package_status) }}</span> --}}
                                {{-- <span class="package-status package-status--active">Active</span> --}}
                                <div class="d-flex flex-column">
                                    <h6 class="package-status package-status--active">Active</h6>
                                    <h6 class="package-status package-status--active">Active</h6>
                                    <h6 class="package-status package-status--active">Active</h6>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default btn-icon btn-icon__open-row cursor-pointer" :class="{ 'd-flex': isOpen === false }" title="View More Details" x-on:click="alert('Test 1?')"></a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default btn-icon btn-icon__close-row  cursor-pointer" :class="{ 'd-flex': isOpen === true }" title="View Less Details" x-on:click="alert('Test 2?')"></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h6>No Records Found!!!</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</div>