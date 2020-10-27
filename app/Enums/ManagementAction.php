<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ManagementAction extends Enum
{
    public const NONE = 'none';
    public const ALL = 'all';
    public const NEW_ACTIVE_ACCOUNT = 'newOrActiveAccount';
    public const ADD_NEW_CUSTOMER_ACCOUNT = 'addNewCustomerAccount';
    public const EXPIRED_COMPLETED_ACCOUNT = 'expiredOrComplementedAccount';
}
