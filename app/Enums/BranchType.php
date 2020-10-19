<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BranchType extends Enum
{
    public const SUPER_ADMIN = 'super_admin';
    public const ADMIN = 'admin';
    public const SALON = 'salon';
    public const GYM = 'gym';
    public const SPA = 'spa';
}
