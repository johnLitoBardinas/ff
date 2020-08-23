<div>
    @if ($type === 'expiredOrComplementedAccount')
        <a class="cursor-pointer" href="{{route('customer-renew', encrypt($customerId))}}" title="Renew the Customer">
            <img src="{{ asset($editRowIcon) }}" alt="Edit Transacition">
        </a>
        <a class="cursor-pointer" href="javascript:void(0);" title="View Related Assets (Image)">
            <img src="{{ asset('svg/icons/view_more.svg') }}" alt="View More Detalils">
        </a>
    @else
        <a class="cursor-pointer" href="javascript:void(0);" title="View Related Assets (Image)">
            <img src="{{ asset('svg/icons/view_more.svg') }}" alt="View More Detalils">
        </a>
    @endif

</div>
