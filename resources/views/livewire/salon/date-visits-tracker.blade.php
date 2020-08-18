<div class="w-100 d-flex justify-content-around">
    @for ($i = 0; $i < $maxVisits; $i++)
        @if (! empty($customerPackageVisits[$i]) )
            <div class="w-25 d-flex flex-column mr-1">
                <button class="btn btn-sm btn-default border btn__ff--primary active">
                    {{date('n-j-Y', strtotime($customerPackageVisits[$i]['date']))}}
                </button>
            </div>

        @else
            <div class="w-25 d-flex flex-column mr-1">
                <button class="btn btn-sm btn-default border btn__ff--primary">+add</button>
            </div>
        @endif
    @endfor
</div>
