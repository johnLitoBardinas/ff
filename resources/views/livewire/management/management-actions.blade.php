<div class="col-md-6 flex" x-data="{ action: '{{$action}}' }">
    <div class="d-inline-block">
        <a href="{{ route('new-customer') }}"
        class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__adduser"
        title="Click to ADD New Customer Account."
        > &nbsp;ADD NEW CUSTOMER</a>
    </div>

    <div class="d-inline-block">
        <a href="{{ route('customer-list') }}" class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__renew"
        title="Click to ADD New Customer Account."
        > &nbsp;RENEW CUSTOMER</a>
    </div>
</div>
