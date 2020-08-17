<div class="col-md-6 flex" x-data="{ action: '{{$action}}' }">
    <button
    class="btn btn-sm btn-default border btn__ff--primary"
    :class="[ action === 'newOrActiveAccount' ? 'active' : ( action === 'expiredOrComplementedAccount' ? 'd-none' : '') ]"
    x-on:click="action = 'newOrActiveAccount'"
    wire:click="$emitTo('salon.salon-table', 'onClickNewOrActiveAccount')"
    title="Click to view all NEW and ACTIVE Accounts.">NEW & ACTIVE ACCNT</button>

    <a href="{{ route('new-customer') }}"
    class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__adduser d-none"
    :class="[ action === 'newOrActiveAccount' ? 'd-inline' : ( action === 'expiredOrComplementedAccount' ? 'd-none' : '') ]"
    title="Click to ADD New Customer Account."
    >ADD NEW CUSTOMER</a>

    <button
    class="btn btn-sm btn-default border btn__ff--primary"
    :class="[ action === 'expiredOrComplementedAccount' ? 'active' : ( action === 'newOrActiveAccount' ? 'd-none' : '' )]"
    x-on:click="action = 'expiredOrComplementedAccount'"
    wire:click="$emitTo('salon.salon-table', 'onExpiredOrComplementedAccount')"
    title="Click to view ALl Expired & Completed Accounts."
    >EXPIRED & COMPLETED ACCNT</button>

    <button
    class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none"
    :class="[ action != 'none' ? 'd-inline' : '' ]"
    x-on:click="action = 'none'"
    wire:click="$emitTo('salon.salon-table', 'OnNone')"
    >EXIT</button>

</div>
