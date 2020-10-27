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
                                     <td>{{strtoupper($row->package->package_name)}}</td>
                                     <td>SALON</td>
                                     @if($packageType === 'salon')
                                       <td>{{number_format($row->package->package_price)}}</td>
                                     @else
                                       <td class="text-line-through">Free</td>
                                     @endif

                                     <td>

                                       @if ($row->package->salon_days_valid_count && $row->package->salon_no_of_visits)
                                          <?php $currentSalonVisitation = $row->customer_visits->filter(fn($item) => $item->package_type === 'salon')->toArray(); ?>
                                          <div class="w-100 d-flex justify-content-between">
                                             @for ($i = 0; $i < $row->package->salon_no_of_visits; $i++)
                                                <div class="w-auto d-flex flex-column">
                                                   @if (! empty($currentSalonVisitation[$i]))
                                                      <div class="w-auto d-flex flex-column">
                                                         <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                            {{date('n-j-Y', strtotime($currentSalonVisitation[$i]['date']))}}
                                                        </button>
                                                      </div>
                                                   @else
                                                      <div class="w-auto d-flex flex-column">
                                                         <a
                                                         href="{{ route('customer-visits', [
                                                         'customer_package_id' => encrypt($row->customer_package_id),
                                                         'package_type' => encrypt('salon'),
                                                         ])}}"
                                                         class="btn btn-sm btn-default border btn__ff--primary">+add</a>
                                                   </div>
                                                   @endif
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
                                  {{-- ./salon-row --}}

                                  <tr>
                                     <td></td>
                                     <td>GYM</td>
                                     @if($packageType === 'gym')
                                       <td>{{number_format($row->package->package_price)}}</td>
                                     @else
                                       <td class="text-line-through">Free</td>
                                     @endif

                                     <td>
                                       @if ($row->package->gym_days_valid_count && $row->package->gym_no_of_visits)
                                          <?php $currentGymVisitation = $row->customer_visits->filter(fn($item) => $item->package_type === 'gym')->toArray(); ?>
                                          @for ($i = 0; $i < $row->package->gym_no_of_visits; $i++)
                                             <div class="w-auto d-flex flex-column">
                                                @if (! empty($currentGymVisitation))
                                                   <div class="w-auto d-flex flex-column">
                                                      <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                         {{date('n-j-Y', strtotime($currentGymVisitation[$i]['date']))}}
                                                      </button>
                                                   </div>
                                                @else
                                                <div class="w-auto d-flex flex-column">
                                                   <a href="{{ route('customer-visits', [
                                                      'customer_package_id' => encrypt($row->customer_package_id),
                                                      'package_type' => encrypt('salon'),
                                                      ])}}"
                                                      class="btn btn-sm btn-default border btn__ff--primary">+add
                                                   </a>
                                               </div>
                                                @endif
                                             </div>
                                          @endfor
                                       @else
                                          <span>No Gym</span>
                                       @endif
                                     </td>

                                     <td>
                                       @if (now()->lessThan($row->gym_package_end))
                                          {{date('M. d, Y', strtotime('-1 day', strtotime($row->gym_package_end)))}}
                                       @endif
                                     </td>
                                     <td>
                                        @if (! empty($row->package->gym_days_valid_count))
                                          <span class="package-status package-status--{{$row->gym_package_status}}">{{ strtoupper($row->gym_package_status) }}</span>
                                        @endif
                                     </td>
                                  </tr>
                                  {{-- ./gym-row --}}

                                  <tr>
                                    <td></td>
                                    <td>SPA</td>
                                    @if($packageType === 'spa')
                                      <td>{{number_format($row->package->package_price)}}</td>
                                    @else
                                      <td class="text-line-through">Free</td>
                                    @endif

                                    <td>
                                      @if ($row->package->spa_days_valid_count && $row->package->spa_no_of_visits)
                                       <?php $currentSpaVisitation = $row->customer_visits->filter(fn($item) => $item->package_type === 'salon')->toArray(); ?>
                                       <div class="w-100 d-flex justify-content-between">
                                          @for ($i = 0; $i < $row->package->salon_no_of_visits; $i++)
                                             <div class="w-auto d-flex flex-column">
                                                @if (! empty($currentSpaVisitation[$i]))
                                                   <div class="w-auto d-flex flex-column">
                                                      <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                         {{date('n-j-Y', strtotime($currentSpaVisitation[$i]['date']))}}
                                                      </button>
                                                   </div>
                                                @else
                                                <div class="w-auto d-flex flex-column">
                                                   <a href="{{ route('customer-visits', [
                                                      'customer_package_id' => encrypt($row->customer_package_id),
                                                      'package_type' => encrypt('salon'),
                                                      ])}}"
                                                   class="btn btn-sm btn-default border btn__ff--primary">+add</a>
                                                @endif
                                             </div>
                                          @endfor
                                       </div>
                                      @else
                                       <span>No Spa</span>
                                      @endif
                                    </td>

                                    <td>
                                       @if (now()->lessThan($row->spa_package_end))
                                          {{date('M. d, Y', strtotime('-1 day', strtotime($row->spa_package_end)))}}
                                       @endif
                                    </td>
                                    <td>
                                       @if (! empty($row->package->spa_days_valid_count))
                                          <span class="package-status package-status--{{$row->spa_package_status}}">{{ strtoupper($row->spa_package_status) }}</span>
                                       @endif
                                    </td>

                                  </tr>
                                  {{-- ./spa-row --}}

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