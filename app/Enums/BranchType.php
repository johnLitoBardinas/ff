<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BranchType extends Enum
{
    // Used by the super admin.
    const SUPER_ADMIN = 'super_admin';
    const SALON = 'salon';
    const GYM = 'gym';
    const SPA = 'spa';
}
