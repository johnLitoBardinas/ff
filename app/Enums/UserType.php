<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserType extends Enum
{
    // Used this user type to create a super admin user.
    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const CASHIER = 'cashier';
}
