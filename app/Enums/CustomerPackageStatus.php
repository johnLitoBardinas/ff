<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CustomerPackageStatus extends Enum
{
    public const ACTIVE = 'active';
    public const EXPIRED = 'expired';
    public const COMPLETED = 'completed';
}
