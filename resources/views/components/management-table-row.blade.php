@props([
    'row' => [],
    'currentUser' => [],
    'userBranchType' => '',
    'customerPackageStatus' => '',
    'servicesType' => config('constant.default_package_type')
])

<tr wire:loading.remove>
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

                @foreach ($servicesType as $type)
                    @php
                        $serviceEndDate = sprintf('%s_package_end', $type);
                        $serviceDaysValid = sprintf('%s_days_valid_count', $type);
                        $serviceNoOfVisits = sprintf('%s_no_of_visits', $type);
                        $serviceStatus = sprintf('%s_package_status', $type);
                    @endphp
                    <tr>
                        <td>
                            @if ($row->package_type === $type) {{ strtoupper($row->package->package_name) ?? '' }} @endif
                        </td>
                        <td>{{strtoupper($type)}}</td>
                        @if($row->package_type === $type)
                            <td>{{number_format($row->package->package_price)}}</td>
                        @else
                            <td>Free</td>
                        @endif
                        <td>
                            @if ($userBranchType === 'gym' && $row->package_type === 'gym' && $type === 'gym')

                                <div class="w-100 d-flex justify-content-between" x-data="{
                                    'currentGymVisitation': '{{$row->gym_visitation->last()->visitation_type ?? 'none'}}'
                                    }">
                                    <div class="w-100 d-flex flex-column">
                                        <div class="w-auto d-flex flex-row justify-content-between gym-visitation">

                                        @if (! empty($row->customer_visits->groupBy('package_type')->toArray()['gym'][0]))
                                            <div class="w-auto d-flex flex-column">
                                                    <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                    {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()['gym'][0]['date']))}}
                                                    </button>
                                            </div>
                                        @endif

                                        <div class="w-auto d-flex flex-column">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-default border btn__ff--primary" :class="{ 'active': currentGymVisitation === 'IN' }" data-action="customerGymVisitation" data-customer="{{$row->customer->customer_id}}" data-cpackageid="{{$row->customer_package_id}}" data-branch="{{$currentUser->branch_id}}" data-userid="{{$currentUser->user_id}}" data-visitation="IN">IN</a>
                                        </div>

                                        <div class="w-auto d-flex flex-column">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-default border btn__ff--primary" :class="{ 'active': currentGymVisitation === 'OUT' }"  data-action="customerGymVisitation" data-customer="{{$row->customer->customer_id}}" data-cpackageid="{{$row->customer_package_id}}" data-branch="{{$currentUser->branch_id}}" data-userid="{{$currentUser->user_id}}" data-visitation="OUT">OUT</a>
                                        </div>

                                        </div>
                                    </div>
                                </div>

                            @else

                                @if (! empty($row->package->$serviceDaysValid) && ! empty($row->package->$serviceNoOfVisits) )
                                    <div class="w-100 d-flex justify-content-between">
                                    @for ($i = 0; $i < $row->package->$serviceNoOfVisits; $i++)
                                        <div class="w-auto d-flex flex-column">
                                            <div class="w-auto d-flex flex-column">

                                                @if (! empty($row->customer_visits->groupBy('package_type')->toArray()[$type][$i]))
                                                    <div class="w-auto d-flex flex-column">

                                                        @if ($userBranchType === $type)
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                            {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()[$type][$i]['date']))}}
                                                            </button>
                                                        @else
                                                            <span class="btn btn-sm btn-default border border-danger disabled text-line-through" disabled title="Service already cosumed on {{date('n-j-Y', strtotime($row->customer_visits->groupBy('package_type')->toArray()[$type][$i]['date']))}}">consumed</span>
                                                        @endif

                                                    </div>
                                                @else

                                                    @if ($userBranchType === $type && $row->$serviceStatus === 'active')
                                                        <a href="{{ route('customer-visits', [
                                                        'customer_package_id' => encrypt($row->customer_package_id),
                                                        'package_type' => encrypt($type),
                                                        ])}}"
                                                        class="btn btn-sm btn-default border btn__ff--primary">
                                                        +add
                                                        </a>
                                                    @elseif($row->$serviceStatus === 'expired')
                                                        <span class="btn btn-sm btn-default border border-danger disabled" disabled title="Service expired">expired</span>
                                                    @else
                                                        <span class="btn btn-sm btn-default border border-success disabled" disabled title="Visit the nearest {{ucfirst($type)}} to consume.">consumable</span>
                                                    @endif

                                                @endif

                                            </div>
                                        </div>
                                    @endfor
                                    </div>
                                @endif

                            @endif
                        </td>
                        <td>
                            {{date('M. d, Y', strtotime('-1 day', strtotime($row->$serviceEndDate)))}}
                        </td>
                        <td>
                        <span class="package-status package-status--{{$row->$serviceStatus}}">{{ strtoupper($row->$serviceStatus) }}</span>
                        </td>
                    </tr>
                @endforeach
           </tbody>
         </table>
      </div>
   </td>
   <td class="d-flex">
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