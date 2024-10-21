<?php

declare(strict_types=1);

namespace Ranjeet\Php\Enums;

/**
 * Enum BillingPeriod
 *
 * Represents the billing periods available for subscriptions.
 * The options include monthly and annual billing periods.
 */
enum BillingPeriod: string {
    case MONTHLY = 'monthly';
    case ANNUAL = 'annual';
}
