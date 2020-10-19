<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentType extends Enum
{
    public const GCASH = 'gcash';
    public const PAYMAYA = 'paymaya';
    public const CARD = 'card';
}
