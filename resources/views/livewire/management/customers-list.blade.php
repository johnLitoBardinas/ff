<div class="container mt-4">

    <div class="row mt-4 justify-content-center">
        <div class="col-md-6">
            <div class="input-group md-form form-sm form-1 pl-0 admin-searchbar">
                <form method="POST" class="d-flex w-100 position-relative" wire:submit.prevent="searchField">
                    @csrf
                    <input
                    class="form-control my-0 py-1 search__input"
                    type="search" placeholder="Enter Reference No or Customer Name"
                    aria-label="Enter Reference No or Customer Name"
                    wire:model.lazy="customerOrRefNumberField"
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
                           <h4>Loading records ...</h4>
                        </td>
                    </tr>

                    <tr>
                        <td class="align-middle">Bardinas</td>
                        <td class="align-middle">John Lito</td>
                        <td class="align-middle">53287SGYF</td>
                        <td class="align-middle">2 Gym - Gym Package</td>
                        <td class="align-middle">
                            <a class="btn btn-sm btn-default cursor-pointer d-inline-block border border-dark" href="{{route('customer-renew', [
                                'encrypted_customer_id' => encrypt(1)
                                ])}}" title="Renew the Customer">
                                Renew
                            </a>
                        </td>
                    </tr>

                    <tr>
                       <td colspan="5">
                          <h6>No Records Found!!</h6>
                       </td>
                    </tr>
                 </tbody>
              </table>
           </div>
        </div>
     </div>

</div>