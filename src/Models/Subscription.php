<?php

declare(strict_types=1);

namespace Ranjeet\Php\Models;

use DateTime;
use Ranjeet\Php\Enums\BillingPeriod;

class Subscription {
    private DateTime $startDate;
    private DateTime $endDate;
    private float $price;

    /**
     * Subscription constructor.
     *
     * @param string $id The unique identifier for the subscription.
     * @param string $customerId The unique identifier for the customer.
     * @param BillingPeriod $billingPeriod The billing period (monthly or annual).
     * @param float $price The price of the subscription.
     * @param DateTime|null $startDate The start date of the subscription; defaults to the current date if not provided.
     */
    public function __construct(
        private string $id,
        private string $customerId,
        private BillingPeriod $billingPeriod,
        float $price,
        ?DateTime $startDate = null
    ) {
        $this->startDate = $startDate ?? new DateTime();
        $this->price = $price;
        $this->endDate = clone $this->startDate;

        // Set end date based on billing period
        match ($billingPeriod) {
            BillingPeriod::MONTHLY => $this->endDate->modify('+1 month'),
            BillingPeriod::ANNUAL => $this->endDate->modify('+1 year'),
        };
    }

    /**
     * Gets the unique identifier for the subscription.
     *
     * @return string The subscription ID.
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * Gets the unique identifier for the customer.
     *
     * @return string The customer ID.
     */
    public function getCustomerId(): string {
        return $this->customerId;
    }

    /**
     * Gets the price of the subscription.
     *
     * @return float The subscription price.
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * Gets the billing period for the subscription.
     *
     * @return BillingPeriod The billing period (monthly or annual).
     */
    public function getBillingPeriod(): BillingPeriod {
        return $this->billingPeriod;
    }

    /**
     * Gets the end date of the subscription.
     *
     * @return DateTime The end date of the subscription.
     */
    public function getEndDate(): DateTime {
        return $this->endDate;
    }

    /**
     * Checks if the subscription is expired.
     *
     * @return bool True if the subscription has expired; otherwise, false.
     */
    public function isExpired(): bool {
        return new DateTime() > $this->endDate;
    }
}
