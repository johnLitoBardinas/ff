<div>

    @if ($type === 'expiredOrComplementedAccount')
        <a href="javascript:void(0);">
            <img src="{{ asset($editRowIcon) }}" alt="Edit Transacition">
        </a>
        <a href="javascript:void(0);">
            <img src="{{ asset('svg/icons/view_more.svg') }}" alt="Edit Transacition">
        </a>
    @else
        <a href="javascript:void(0);">
            <img src="{{ asset('svg/icons/view_more.svg') }}" alt="Edit Transacition">
        </a>
    @endif

</div>
