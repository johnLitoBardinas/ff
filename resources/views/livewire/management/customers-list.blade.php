<div class="container mt-4">

    <div class="row mt-4 justify-content-center">
        <div class="col-md-6">
            <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
                <form method="POST" class="d-flex w-100 position-relative" wire:submit.prevent="searchCustomer">
                    @csrf
                    <input
                    class="form-control my-0 py-1 search__input"
                    type="search" placeholder="Enter Reference No or Customer Name"
                    aria-label="Enter Reference No or Customer Name"
                    wire:model.lazy="refNoOrCustomerName"
                    />
                    <button type="submit" title="Click to Search Customer Name." class="cursor-pointer"><img src="{{ asset( 'svg/icons/search.svg' ) }}" alt="Search Icon"></button>
                </form>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-12">
           <div class="table-responsive">
              <table class="table table-hover admin-table">
                 <thead class="text-white bg-primary">
                    <tr>
                       <th scope="col">
                            LAST NAME
                       </th>
                       <th scope="col">
                            FIRST NAME
                       </th>
                       <th scope="col">
                            REF. NUMBER
                       </th>
                       <th scope="col">
                            PACKAGE
                        </th>
                       <th scope="col">
                            ACTION
                       </th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr wire:loading>
                        <td colspan="5">
                           <h6>Loading records ...</h6>
                        </td>
                    </tr>

                    @forelse ($customers as $row)
                        <tr wire:loading.remove>
                            <td class="align-middle">{{$row->customer->last_name}}</td>
                            <td class="align-middle">{{$row->customer->first_name}}</td>
                            <td class="align-middle">{{$row->reference_no}}</td>
                            <td class="align-middle">{{$row->package->package_name}}</td>
                            <td class="align-middle">
                                <a class="btn btn-sm btn-default cursor-pointer d-inline-block border border-dark" href="{{route('customer-renew', [
                                    'encrypted_customer_id' => encrypt($row->customer_id)
                                    ])}}" title="Renew the Customer">
                                    Renew
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr wire:loading.remove>
                            <td colspan="5">
                            <h6>No Records Found!!</h6>
                            </td>
                        </tr>
                    @endforelse

                 </tbody>
              </table>
           </div>
        </div>
     </div>

</div>