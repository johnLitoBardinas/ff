<div class="row mt-4">
    <div class="col-md-12">
       <div class="table-responsive">
          <table class="table table-hover admin-table" style="width:100%;" id="management-table">
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
                  <x-management-table-row :row="$row" :currentUser="$currentUser" :userBranchType="$userBranchType" :customerPackageStatus="$customerPackageStatus" />
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