<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccessHomeType extends Enum
{
    public const FFCO = 'f-and-f.co';
    public const FFSALON = 'fix-and-free.salon';
    public const FFGYM = 'fit-and-free.gym';
    public const FFWELLNESS = 'fib-and-free.wellness';
}
