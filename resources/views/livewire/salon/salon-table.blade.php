<div class="row mt-4">
    {{-- {{dd($customerPackageVisitsInfo)}} --}}
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
                        <tr>
                            <td>{{$row->reference_no}}</td>
                            <td>{{$row->customer->first_name}}</td>
                            <td>{{$row->customer->last_name}}</td>
                            <td>{{strtoupper($row->payment_type)}}</td>
                            <td>{{strtoupper($row->package->package_name)}}</td>
                            <td>
                                @livewire('salon.date-visits-tracker', [
                                    'customerPackageVisits' => $row->customer_visits,
                                    'customerPackageReferenceNo' => $row->reference_no,
                                    'customerPackageId' => $row->customer_package_id
                                ])
                            </td>
                            <td>
                                {{date('M. d, Y', strtotime( $row->customer_package_end ) )}}
                            </td>
                            <td>
                                @livewire('salon.package-status-label', [
                                    'type' => $row->customer_package_status
                                ])
                            </td>
                            <td>
                                @livewire('salon.table-action', [
                                    'type' => $currentDisplayType,
                                    'customerId' => $row->customer->customer_id
                                ])
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