<div class="container mt-4">

    <div class="row mt-4 justify-content-center">

        <div class="col-12 col-lg-10">
            <h3 class="text-uppercase text-dark text-center font-weight-light">User Emails</h3>
            <div class="table-responsive">
                <table class="table table-hover admin-table" style="width:100%;" id="user-email-tables">
                    <thead class="text-white bg-primary">
                        <tr>
                            <th scope="col">
                                EMPLOYEE NAME
                            </th>
                            <th scope="col">
                                BRANCH
                            </th>
                            <th scope="col">
                                ACCOUNT TYPE
                            </th>
                            <th scope="col">
                                EMAIL
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{sprintf('%s, %s', $user->last_name, $user->first_name)}}</td>
                            <td>{{$user->branch->branch_name}}</td>
                            <td>{{$user->role->name}}</td>
                            <td colspan="2">
                                <input type="email" name="email" value="{{$user->email}}" class="w-70"/>
                                <button class="btn btn-sm btn-default border btn__ff--primary active" data-userid="{{$user->user_id}}" data-sadmin="{{encrypt($superAdmin)}}" data-useroldemail="{{$user->email}}">Update</button>
                            </td>
                         </tr>
                        @empty
                        <tr>
                            <td colspan="4">
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
