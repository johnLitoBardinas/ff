<div>

    @if ($type === 'expiredOrComplementedAccount')
        <a href="javascript:void(0);">
            <img src="{{ asset($editRowIcon) }}" alt="Edit Transacition">
        </a>
        <a href="javascript:void(0);">
            <img src="https://via.placeholder.com/24x24" alt="Edit Transacition">
        </a>
    @else
        <a href="javascript:void(0);">
            <img src="https://via.placeholder.com/24x24" alt="Edit Transacition">
        </a>
    @endif

</div>
