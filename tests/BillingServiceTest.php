<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ranjeet\Php\Services\BillingService;
use Ranjeet\Php\Repositories\SubscriptionRepositoryInterface;
use Ranjeet\Php\Models\Subscription;
use Ranjeet\Php\Enums\BillingPeriod;

class BillingServiceTest extends TestCase
{
    public function testCreateSubscription(): void
    {
        // Create a mock of SubscriptionRepositoryInterface
        /** @var SubscriptionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject $subscriptionRepository */
        $subscriptionRepository = $this->createMock(SubscriptionRepositoryInterface::class);
        
        // Expect the save method to be called once with a Subscription instance
        $subscriptionRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Subscription::class));

        // Instantiate BillingService with the mock
        $billingService = new BillingService($subscriptionRepository);

        // Create a subscription
        $subscription = $billingService->createSubscription(
            'customer_001',
            19.99,
            BillingPeriod::MONTHLY
        );

        // Assert the subscription properties
        $this->assertSame('customer_001', $subscription->getCustomerId());
        $this->assertSame(BillingPeriod::MONTHLY, $subscription->getBillingPeriod());
        $this->assertSame(19.99, $subscription->getPrice());
    }

    public function testRenewSubscription(): void
    {
        // Create a mock of SubscriptionRepositoryInterface
        /** @var SubscriptionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject $subscriptionRepository */
        $subscriptionRepository = $this->createMock(SubscriptionRepositoryInterface::class);
        
        // Create an existing subscription
        $existingSubscription = new Subscription(
            'sub_12345',
            'customer_001',
            BillingPeriod::MONTHLY,
            19.99
        );

        // Define the expected return for the renew method
        $subscriptionRepository
            ->method('renew')
            ->willReturn(new Subscription(
                'sub_54321',
                'customer_001',
                BillingPeriod::MONTHLY,
                19.99
            ));

        // Instantiate BillingService with the mock
        $billingService = new BillingService($subscriptionRepository);

        // Renew the subscription
        $newSubscription = $billingService->renewSubscription($existingSubscription);

        // Assert the new subscription properties
        $this->assertSame('sub_54321', $newSubscription->getId());
        $this->assertSame('customer_001', $newSubscription->getCustomerId());
        $this->assertSame(BillingPeriod::MONTHLY, $newSubscription->getBillingPeriod());
    }
}
