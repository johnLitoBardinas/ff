<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserType extends Enum
{
    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const CASHIER = 'cashier';
}
