<?php

declare(strict_types=1);

namespace Ranjeet\Php\Tests;

use PHPUnit\Framework\TestCase;
use Ranjeet\Php\Models\Subscription;
use Ranjeet\Php\Enums\BillingPeriod;

class SubscriptionTest extends TestCase
{
    public function testSubscriptionInitialization(): void
    {
        // Arrange
        $customerId = 'cust_123';
        $price = 19.99;
        $billingPeriod = BillingPeriod::MONTHLY;

        // Act
        $subscription = new Subscription(uniqid('sub_', true), $customerId, $billingPeriod, $price);

        // Assert
        $this->assertEquals($customerId, $subscription->getCustomerId());
        $this->assertEquals($price, $subscription->getPrice());
        $this->assertEquals($billingPeriod, $subscription->getBillingPeriod());
        $this->assertFalse($subscription->isExpired());
    }

    public function testSubscriptionEndDateForMonthly(): void
    {
        // Arrange
        $customerId = 'cust_123';
        $price = 19.99;
        $billingPeriod = BillingPeriod::MONTHLY;
        $subscription = new Subscription(uniqid('sub_', true), $customerId, $billingPeriod, $price);

        // Act
        $startDate = $subscription->getEndDate();
        $expectedEndDate = (new \DateTime())->modify('+1 month');

        // Assert
        $this->assertEquals($expectedEndDate->format('Y-m-d'), $startDate->format('Y-m-d'));
    }
}
