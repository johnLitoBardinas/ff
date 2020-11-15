<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
}
