<div class="row mt-4">
    <div class="col-md-12">
       <div class="table-responsive">
          <table class="table table-hover admin-table" style="width:100%;" id="salon-table">
             <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width:10%;">
                <col span="1" style="width: 60%;">
                <col span="1" style="width: 5%;">
             </colgroup>
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
                      PACKAGE INFORMATION
                   </th>
                   <th scope="col"></th>
                </tr>
             </thead>
             <tbody>
                @forelse ($customerPackageVisitsInfo as $row)
                <tr>
                    <td>{{strtoupper($row->reference_no)}}</td>
                    <td>{{sprintf('%s, %s', ucfirst($row->customer->last_name), ucfirst($row->customer->first_name))}}</td>
                    <td>{{strtoupper($row->payment_type)}}</td>
                   <td>
                      <div class="table-responsive table-hover cursor-pointer">
                         <table class="table">
                            <thead style="white-space:nowrap;">
                               <tr>
                                  <th class="text-primary font-weight-bold">NAME</th>
                                  <th class="text-primary font-weight-bold">TYPE</th>
                                  <th class="text-primary font-weight-bold">PRICE</th>
                                  <th class="text-primary font-weight-bold">VISITS</th>
                                  <th class="text-primary font-weight-bold">VALID UNTIL</th>
                                  <th class="text-primary font-weight-bold">STATUS</th>
                               </tr>
                            </thead>
                               <tbody style="white-space:nowrap;" class="d-none">
                                  <tr>
                                     <td>{{strtoupper($row->package->package_name)}}</td>
                                    <td>{{strtoupper($row->package->package_type)}}</td>
                                    <td>{{number_format($row->package->package_price)}}</td>
                                     <td>
                                        <?php $customerSalonVisits = $row->customer_visits->filter(fn($item) => $item->package_type === 'salon')->toArray(); ?>
                                        <div class="w-100 d-flex justify-content-between">
                                           @for ($i = 0; $i < $row->package->salon_no_of_visits; $i++)
                                           <div class="w-auto d-flex flex-column">
                                            @if ( ! empty($customerSalonVisits[$i]) )
                                                <div class="w-auto d-flex flex-column">
                                                    <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                        {{date('n-j-Y', strtotime($customerSalonVisits[$i]['date']))}}
                                                    </button>
                                                </div>
                                            @else
                                                <div class="w-auto d-flex flex-column">
                                                    <a
                                                    href="{{ route('customer-visits', [
                                                      'customer_package_id' => encrypt($row->customer_package_id),
                                                      'package_type' => encrypt('salon'),
                                                   ])}}"
                                                    class="btn btn-sm btn-default border btn__ff--primary">
                                                    +add
                                                    </a>
                                                </div>
                                             @endif
                                           </div>
                                           @endfor
                                        </div>
                                     </td>
                                    <td>
                                        {{date('M. d, Y', strtotime('-1 day', strtotime($row->salon_package_end)))}}
                                    </td>
                                    <td>
                                        <span class="package-status package-status--{{$row->salon_package_status}}">{{ strtoupper($row->salon_package_status) }}</span>
                                    </td>
                                  </tr>
                                  {{-- ./salon-row --}}
                                  <tr>
                                     <td></td>
                                     <td>GYM</td>
                                     <td class="text-line-through">Free</td>
                                     <td>
                                        <?php $customerGymVisits = $row->customer_visits->filter(fn($item) => $item->package_type === 'gym')->toArray(); ?>
                                        <div class="w-100 d-flex justify-content-start">
                                           @for ($i = 0; $i < $row->package->gym_no_of_visits; $i++)
                                           <div class="w-auto d-flex flex-column mr-1">
                                            @if ( ! empty($customerGymVisits[$i]) )
                                                <div class="w-auto d-flex flex-column">
                                                    <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                        {{date('n-j-Y', strtotime($customerGymVisits[$i]['date']))}}
                                                    </button>
                                                </div>
                                            @else
                                                <div class="w-auto d-flex flex-column">
                                                    {{-- <a
                                                    href="{{ route('customer-visits', [
                                                       'customer_package_id' => encrypt($row->customer_package_id),
                                                       'package_type' => encrypt('gym')
                                                    ])}}"
                                                    class="btn btn-sm btn-default border btn__ff--primary">
                                                    +add
                                                    </a> --}}
                                                    <span class="text-line-through">Unavailable</span>
                                                </div>
                                            @endif
                                           </div>
                                           @endfor
                                        </div>
                                     </td>
                                    <td>
                                        {{date('M. d, Y', strtotime('-1 day', strtotime($row->gym_package_end)))}}
                                    </td>
                                     <td>
                                        <span class="package-status package-status--{{$row->gym_package_status}}">{{ strtoupper($row->gym_package_status) }}</span>
                                     </td>
                                  </tr>
                                  {{-- ./gym-row --}}
                                  <tr>
                                     <td></td>
                                     <td>SPA</td>
                                     <td class="text-line-through">Free</td>
                                     <td>
                                        <?php $customerSpaVisits = $row->customer_visits->filter(fn($item) => $item->package_type === 'spa')->toArray(); ?>

                                        <div class="w-100 d-flex justify-content-start">
                                           @for ($i = 0; $i < $row->package->spa_no_of_visits; $i++)
                                           <div class="w-auto d-flex flex-column mr-1">
                                            @if ( ! empty($customerSpaVisits[$i]) )
                                                <div class="w-auto d-flex flex-column">
                                                    <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                        {{date('n-j-Y', strtotime($customerSpaVisits[$i]['date']))}}
                                                    </button>
                                                </div>
                                            @else
                                                <div class="w-auto d-flex flex-column">
                                                    {{-- <a
                                                    href="{{ route('customer-visits', [
                                                      'customer_package_id' => encrypt($row->customer_package_id),
                                                      'package_type' => encrypt('spa')
                                                      ])}}"
                                                    class="btn btn-sm btn-default border btn__ff--primary">
                                                    +add
                                                    </a> --}}
                                                    <span class="text-line-through">Unavailable</span>
                                                </div>
                                            @endif
                                           </div>
                                           @endfor
                                        </div>
                                     </td>
                                     <td>
                                        {{date('M. d, Y', strtotime('-1 day', strtotime($row->spa_package_end)))}}
                                     </td>
                                     <td>
                                        <span class="package-status package-status--{{$row->spa_package_status}}">{{ strtoupper($row->spa_package_status) }}</span>
                                     </td>
                                  </tr>
                                  {{-- ./spa-row --}}
                               </tbody>
                         </table>
                      </div>
                   </td>
                   <td>
                      <a
                         href="javascript:void(0);"
                         class="btn btn-sm btn-default btn-icon btn-icon__open-row cursor-pointer"
                         data-action="togglePackageInfo"
                         title="View More Details"></a>
                      <a
                         href="javascript:void(0);"
                         class="btn btn-sm btn-default btn-icon btn-icon__close-row  cursor-pointer d-none"
                         title="View Less Details"></a>
                   </td>
                </tr>
                @empty
                <tr>
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