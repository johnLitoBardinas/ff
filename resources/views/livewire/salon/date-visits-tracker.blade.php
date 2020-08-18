<div class="w-100 d-flex justify-content-around">
    @for ($i = 0; $i < $maxVisits; $i++)
        @if (! empty($customerPackageVisits[$i]) )
            <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary active">{{date('n-j-Y', strtotime($customerPackageVisits[$i]['date']))}}</button>
        @else
            <button class="btn btn-sm btn-default w-25 mr-1 border btn__ff--primary">+add</button>
        @endif
    @endfor
</div>

