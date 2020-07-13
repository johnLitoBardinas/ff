<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CustomerPackageStatus extends Enum
{
    const ACTIVE = 'active';
    const EXPIRED = 'expired';
    const COMPLETED = 'completed';
}
