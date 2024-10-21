<?php

declare(strict_types=1);

namespace Ranjeet\Php\Enums;

/**
 * Enum representing the subscription price.
 */
enum Price: string {
    case MONTHLY = 'monthly';
    case ANNUAL = 'annual';

    /**
     * Get the price based on the billing period.
     *
     * @return float
     */
    public function getPrice(): float {
        return match ($this) {
            self::MONTHLY => 19.99,
            self::ANNUAL => 299.99,
        };
    }
}
