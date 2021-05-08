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
               <tr wire:loading>
                  <td colspan="5">
                     <h6>Loading records ...</h6>
                  </td>
               </tr>
                @forelse ($customerPackageVisitsInfo as $row)
                  <x-management-table-row :row="$row" :currentUser="$currentUser" :userBranchType="$userBranchType" :customerPackageStatus="$customerPackageStatus" :defaultRefNo="$refno" />
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

<!-- Management Modal -->
<div class="modal fade mgmt-service-modal" id="mgmt-service-modal" tabindex="-1" role="dialog" aria-labelledby="Managment Service Modal" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title mgmt-service-modal-title"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
        <table class="table table-bordered">
           <thead>
              <tr>
                 <th class="text-center">Date of Visits</th>
                 <th class="text-center">Status</th>
              </tr>
           </thead>
           <tbody class="mgmt-service-modal__tbody">
               {{-- Append the row --}}
           </tbody>
        </table>
       </div>
       <div class="modal-footer">
         <span>TOTAL: <b class="total-visits"></b></span>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>