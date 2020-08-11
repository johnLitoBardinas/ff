<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SalonAction extends Enum
{
    const NONE = 'none';
    const NEW_ACTIVE_ACCOUNT = 'newOrActiveAccount';
    const ADD_NEW_CUSTOMER_ACCOUNT = 'addNewCustomerAccount';
    const EXPIRED_COMPLETED_ACCOUNT = 'expiredOrComplementedAccount';
}
