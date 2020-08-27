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
                            FIRST NAME
                        </th>
                        <th scope="col">
                            LAST NAME
                        </th>
                        <th scope="col">
                            PAYMENT
                        </th>
                        <th scope="col">
                            PACKAGE
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
                        <?php $customerVisits = $row->customer_visits->toArray(); ?>
                        <tr>
                            <td>{{strtoupper($row->reference_no)}}</td>
                            <td>{{ucwords($row->customer->first_name)}}</td>
                            <td>{{ucwords($row->customer->last_name)}}</td>
                            <td>{{strtoupper($row->payment_type)}}</td>
                            <td>{{strtoupper($row->package->package_name)}}</td>
                            <td>
                                <div class="w-100 d-flex justify-content-around">
                                    @for ($i = 0; $i < config('constant.package_visits_limit'); $i++)

                                        @if( empty($customerVisits[$i]) &&  $row->customer_package_status === 'expired')
                                            <button class="btn btn-sm btn-default border w-25" disabled>X</button>
                                        @elseif (! empty($customerVisits[$i]))
                                            <div class="w-25 d-flex flex-column mr-1">
                                                <button class="btn btn-sm btn-default border btn__ff--primary bg-gray active" disabled>
                                                    {{date('n-j-Y', strtotime($customerVisits[$i]['date']))}}
                                                </button>
                                            </div>
                                        @else
                                            <div class="w-25 d-flex flex-column mr-1">
                                                <a
                                                href="{{ route('customer-visits', encrypt($row->customer_package_id))}}"
                                                class="btn btn-sm btn-default border btn__ff--primary">
                                                +add
                                                </a>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td>
                                {{date('M. d, Y', strtotime( $row->customer_package_end ) )}}
                            </td>
                            <td>
                                <span class="package-status package-status--{{$row->customer_package_status}}">{{ strtoupper($row->customer_package_status) }}</span>
                            </td>
                            <td>
                                @if ($row->customer_package_status !== 'active')
                                    <a class="cursor-pointer" href="{{route('customer-renew', encrypt($row->customer->customer_id))}}" title="Renew the Customer">
                                        <img src="{{ asset('svg/icons/table_edit.svg') }}" alt="Edit Transacition">
                                    </a>
                                    <a class="cursor-pointer" href="javascript:void(0);" title="View Related Assets (Image)">
                                        <img src="{{ asset('svg/icons/view_more.svg') }}" alt="View More Detalils">
                                    </a>
                                @else
                                    <a class="cursor-pointer" href="javascript:void(0);" title="View Related Assets (Image)">
                                        <img src="{{ asset('svg/icons/view_more.svg') }}" alt="View More Detalils">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h6>No Records Found!!</h6>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>
</div>