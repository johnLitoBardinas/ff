<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentType extends Enum
{
    const GCASH = 'gcash';
    const PAYMAYA = 'paymaya';
    const CARD = 'card';
}
