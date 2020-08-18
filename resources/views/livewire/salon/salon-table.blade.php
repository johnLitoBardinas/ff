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
                    {{-- {{ $currentDisplayType }} --}}
                    <tr>
                        <td>00000000</td>
                        <td>John Lito</td>
                        <td>Bardinas</td>
                        <td>PAYMAYA</td>
                        <td>Plan 1800</td>
                        <td>
                            @livewire('salon.date-visits-tracker', [ 'packageStatus' => 'active' ])
                        </td>
                        <td>Oct. 11, 2020</td>
                        <td>
                            @livewire('salon.package-status-label', [ 'type' => 'active' ])
                        </td>
                        <td>
                            @livewire('salon.table-action', [ 'type' => 'newOrActiveAccount' ]) {{-- type (New | ExpiredCompleted) --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>