<div class="row mt-4">
    <div class="col-md-12">
       <div class="table-responsive">
          <table class="table table-hover admin-table" style="width:100%;" id="salon-table">
             <colgroup>
                <col span="1" style="width:10%;">
                <col span="1" style="width:15%;">
                <col span="1" style="width:10%;">
                <col span="1" style="width:60%;">
                <col span="1" style="width:5%;">
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
                                 <td>
                                    @if ($currentPackageType === 'gym') {{ strtoupper($row->package->package_name) ?? '' }} @endif
                                 </td>
                                 <td>GYM</td>
                                 @if($currentPackageType === 'gym')
                                    <td>{{number_format($row->package->package_price)}}</td>
                                 @else
                                    <td class="text-line-through">Free</td>
                                 @endif
                                 <td>

                                    @if (! empty($row->package->gym_days_valid_count) && ! empty($row->package->gym_no_of_visits) )
                                        <div class="w-100 d-flex justify-content-between">
                                           @for ($i = 0; $i < $row->package->gym_no_of_visits; $i++)
                                               <div class="w-auto d-flex flex-column">
                                                  <div class="w-auto d-flex flex-column">

                                                     @if (! empty($row->customer_visits->groupBy('package_type')->toArray()['gym'][$i]))
                                                      <div class="w-auto d-flex flex-column">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                               {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()['gym'][$i]['date']))}}
                                                            </button>
                                                      </div>
                                                     @else
                                                      <a href="{{ route('customer-visits', [
                                                         'customer_package_id' => encrypt($row->customer_package_id),
                                                         'package_type' => encrypt('gym'),
                                                         ])}}"
                                                         class="btn btn-sm btn-default border btn__ff--primary">
                                                         +add
                                                      </a>
                                                     @endif

                                                  </div>
                                               </div>
                                           @endfor
                                        </div>
                                    @endif

                                 </td>
                                 <td>
                                    {{date('M. d, Y', strtotime('-1 day', strtotime($row->gym_package_end)))}}
                                 </td>
                                 <td>
                                    <span class="package-status package-status--{{$row->gym_package_status}}">{{ strtoupper($row->gym_package_status) }}</span>
                                 </td>
                              </tr>
                              {{-- GYM --}}

                              <tr>
                                 <td>
                                    @if ($currentPackageType === 'salon') {{ strtoupper($row->package->package_name) ?? '' }} @endif
                                 </td>
                                 <td>SALON</td>
                                 @if($currentPackageType === 'salon')
                                    <td>{{number_format($row->package->package_price)}}</td>
                                 @else
                                    <td class="text-line-through">Free</td>
                                 @endif
                                 <td>

                                    @if (! empty($row->package->salon_days_valid_count) && ! empty($row->package->salon_no_of_visits) )
                                        <div class="w-100 d-flex justify-content-between">
                                           @for ($i = 0; $i < $row->package->salon_no_of_visits; $i++)
                                               <div class="w-auto d-flex flex-column">
                                                  <div class="w-auto d-flex flex-column">

                                                     @if (! empty($row->customer_visits->groupBy('package_type')->toArray()['salon'][$i]))
                                                      <div class="w-auto d-flex flex-column">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                               {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()['salon'][$i]['date']))}}
                                                            </button>
                                                      </div>
                                                     @else
                                                      <a href="{{ route('customer-visits', [
                                                         'customer_package_id' => encrypt($row->customer_package_id),
                                                         'package_type' => encrypt('salon'),
                                                         ])}}"
                                                         class="btn btn-sm btn-default border btn__ff--primary">
                                                         +add
                                                      </a>
                                                     @endif

                                                  </div>
                                               </div>
                                           @endfor
                                        </div>
                                    @endif

                                 </td>
                                 <td>
                                    {{date('M. d, Y', strtotime('-1 day', strtotime($row->salon_package_end)))}}
                                 </td>
                                 <td>
                                    <span class="package-status package-status--{{$row->salon_package_status}}">{{ strtoupper($row->salon_package_status) }}</span>
                                 </td>
                              </tr>
                              {{-- SALON --}}


                              <tr>
                                 <td>
                                    @if ($currentPackageType === 'spa') {{ strtoupper($row->package->package_name) ?? '' }} @endif
                                 </td>
                                 <td>SPA</td>
                                 @if($currentPackageType === 'spa')
                                    <td>{{number_format($row->package->package_price)}}</td>
                                 @else
                                    <td class="text-line-through">Free</td>
                                 @endif
                                 <td>

                                    @if (! empty($row->package->spa_days_valid_count) && ! empty($row->package->spa_no_of_visits) )
                                        <div class="w-100 d-flex justify-content-between">
                                           @for ($i = 0; $i < $row->package->spa_no_of_visits; $i++)
                                               <div class="w-auto d-flex flex-column">
                                                  <div class="w-auto d-flex flex-column">

                                                     @if (! empty($row->customer_visits->groupBy('package_type')->toArray()['spa'][$i]))
                                                      <div class="w-auto d-flex flex-column">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                               {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()['spa'][$i]['date']))}}
                                                            </button>
                                                      </div>
                                                     @else
                                                      <a href="{{ route('customer-visits', [
                                                         'customer_package_id' => encrypt($row->customer_package_id),
                                                         'package_type' => encrypt('spa'),
                                                         ])}}"
                                                         class="btn btn-sm btn-default border btn__ff--primary">
                                                         +add
                                                      </a>
                                                     @endif

                                                  </div>
                                               </div>
                                           @endfor
                                        </div>
                                    @endif

                                 </td>
                                 <td>
                                    {{date('M. d, Y', strtotime('-1 day', strtotime($row->spa_package_end)))}}
                                 </td>
                                 <td>
                                    <span class="package-status package-status--{{$row->spa_package_status}}">{{ strtoupper($row->spa_package_status) }}</span>
                                 </td>
                              </tr>
                              {{-- SALON --}}


                           </tbody>
                         </table>
                      </div>
                   </td>
                   <td class="d-flex">
                      @if ($row->$customerPackageStatus !== 'active')
                      <a class="btn btn-sm btn-default btn-icon btn-icon__edit-row cursor-pointer" href="{{route('customer-renew', [
                         'encrypted_customer_id' => encrypt($row->customer->customer_id)
                        ])}}" title="Renew the Customer">
                      </a>
                      @endif
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