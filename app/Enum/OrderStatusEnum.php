<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    const PROCESSING = 'processing';

    const PURCHASED = 'purchased';

    const PENDING = 'pending';
}
