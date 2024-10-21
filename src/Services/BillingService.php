<?php 

namespace Ranjeet\Php\Services;

use Ranjeet\Php\Repositories\SubscriptionRepositoryInterface;
use Ranjeet\Php\Models\Subscription;
use Ranjeet\Php\Enums\BillingPeriod;
use Ranjeet\Php\Models\Bill;

class BillingService {
    private SubscriptionRepositoryInterface $subscriptionRepository;

    /**
     * BillingService constructor.
     *
     * @param SubscriptionRepositoryInterface $subscriptionRepository The subscription repository implementation.
     */
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository) {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * Creates a new subscription and saves it to the repository.
     *
     * @param string $customerId The ID of the customer subscribing.
     * @param float $price The price of the subscription.
     * @param BillingPeriod $billingPeriod The billing period for the subscription.
     * @return Subscription The newly created subscription object.
     */
    public function createSubscription(string $customerId, float $price, BillingPeriod $billingPeriod): Subscription {
        $subscription = new Subscription(
            uniqid('sub_', true),
            $customerId,
            $billingPeriod,
            $price
        );

        $this->subscriptionRepository->save($subscription);
        
        return $subscription;
    }

    /**
     * Generates a bill for a given subscription.
     *
     * @param Subscription $subscription The subscription for which to generate the bill.
     * @return Bill The generated bill object.
     */
    public function generateBill(Subscription $subscription): Bill {
        return new Bill($subscription, new \DateTime());
    }

    /**
     * Renews an existing subscription and saves the new subscription to the repository.
     *
     * @param Subscription $subscription The subscription to renew.
     * @return Subscription The renewed subscription object.
     */
    public function renewSubscription(Subscription $subscription): Subscription {
        return $this->subscriptionRepository->renew($subscription);
    }
}
