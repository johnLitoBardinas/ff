<div class="col-md-6 flex" x-data="{ action: '{{$action}}' }">
    <button
    class="btn btn-sm btn-default border btn__ff--primary"
    :class="[ action === 'newOrActiveAccount' ? 'active' : ( action === 'expiredOrComplementedAccount' ? 'd-none' : '') ]"
    x-on:click="action = 'newOrActiveAccount'"
    title="Click to view all NEW and ACTIVE Accounts.">NEW & ACTIVE ACCNT</button>

    <button
    class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__adduser d-none"
    :class="[ action === 'newOrActiveAccount' ? 'd-inline' : ( action === 'expiredOrComplementedAccount' ? 'd-none' : '') ]"
    x-on:click="action = 'addNewCustomerAccount'"
    title="Click to ADD New Customer Account.">
        ADD NEW CUSTOMER
    </button>

    <button
    class="btn btn-sm btn-default border btn__ff--primary"
    :class="[ action === 'expiredOrComplementedAccount' ? 'active' : ( action === 'newOrActiveAccount' ? 'd-none' : '' )]"
    x-on:click="action = 'expiredOrComplementedAccount'"
    title="Click to view ALl Expired & Completed Accounts."
    >EXPIRED & COMPLETED ACCNT</button>

    <button
    class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none"
    :class="[ action != 'none' ? 'd-inline' : '' ]"
    x-on:click="action = 'none'"
    >EXIT</button>

</div>
