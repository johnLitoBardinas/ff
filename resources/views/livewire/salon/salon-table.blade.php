<div class="row mt-4">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover admin-table" style="width:100%;" x-data="{isOpen:false}">
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
                            PACKAGE
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>000000000000</td>
                        <td>Francisco, Stephen Reon</td>
                        <td>Paymaya</td>
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
                                    <template x-if="isOpen">
                                    <tbody style="white-space:nowrap;">
                                        <tr>
                                            <td>GROOM</td>
                                            <td>SALON</td>
                                            <td>1,800</td>
                                            <td>
                                                <div class="w-100 d-flex justify-content-between">
                                                    @for ($i = 0; $i < 4; $i++)
                                                        <div class="w-auto d-flex flex-column mr-1">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                                {{-- {{date('n-j-Y', strtotime($customerVisits[$i]['date']))}} --}}
                                                                {{date('n-j-Y', strtotime(now()))}}
                                                            </button>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>Dec. 6, 2020</td>
                                            <td>ACTIVE</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>GYM</td>
                                            <td class="text-line-through">Free</td>
                                            <td>
                                                <div class="w-100 d-flex justify-content-start">
                                                    @for ($i = 0; $i < 1; $i++)
                                                        <div class="w-auto d-flex flex-column mr-1">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                                {{-- {{date('n-j-Y', strtotime($customerVisits[$i]['date']))}} --}}
                                                                {{date('n-j-Y', strtotime(now()))}}
                                                            </button>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>Sept. 18, 2020</td>
                                            <td>ACTIVE</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>SPA</td>
                                            <td class="text-line-through">Free</td>
                                            <td>
                                                <div class="w-100 d-flex justify-content-start">
                                                    @for ($i = 0; $i < 1; $i++)
                                                        <div class="w-auto d-flex flex-column mr-1">
                                                            <button class="btn btn-sm btn-default border btn__ff--primary active" disabled>
                                                                {{-- {{date('n-j-Y', strtotime($customerVisits[$i]['date']))}} --}}
                                                                {{date('n-j-Y', strtotime(now()))}}
                                                            </button>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>Sept. 18, 2020</td>
                                            <td>ACTIVE</td>
                                        </tr>
                                    </tbody>
                                </template>
                                </table>
                            </div>
                        </td>
                        <td>
                            <a
                            href="javascript:void(0);"
                            class="btn btn-sm btn-default btn-icon btn-icon__open-row cursor-pointer d-none"
                            :class="{ 'd-flex' : isOpen === false }"
                            title="View More Details"
                            x-on:click="isOpen = true"></a>

                            <a
                            href="javascript:void(0);"
                            class="btn btn-sm btn-default btn-icon btn-icon__close-row  cursor-pointer d-none"
                            :class="{ 'd-flex': isOpen === true }"
                            title="View Less Details" x-on:click="isOpen = false"></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>