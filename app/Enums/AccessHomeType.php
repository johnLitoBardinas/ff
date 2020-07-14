<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AccessHomeType extends Enum
{
    const FFCO = 'fix-and-free.co';
    const FFSALON = 'fix-and-free.salon';
}
