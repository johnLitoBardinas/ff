<div class="w-100 d-flex justify-content-around">
    @if ($packageStatus === 'active')
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">8-11-2020</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary">+add</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary">+add</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary">+add</button>
    @elseif($packageStatus === 'expired')
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">8-11-2020</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">9-01-2020</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary" disabled>x</button>
        <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary" disabled>x</button>
    @else
    <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">8-11-2020</button>
    <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">9-01-2020</button>
    <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">9-20-2020</button>
    <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">10-10-2020</button>
    @endif

</div>
