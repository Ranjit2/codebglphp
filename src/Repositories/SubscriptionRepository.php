<?php

namespace Ranjeet\Php\Repositories;

use Ranjeet\Php\Models\Subscription;
use DateTime;

class SubscriptionRepository implements SubscriptionRepositoryInterface {
    /**
     * @var Subscription[] Holds the subscriptions in memory.
     */
    private array $subscriptions = [];

    /**
     * Saves a subscription to the repository.
     *
     * @param Subscription $subscription The subscription object to save.
     * @return void
     */
    public function save(Subscription $subscription): void {
        $this->subscriptions[$subscription->getId()] = $subscription;
    }

    /**
     * Finds a subscription by its ID.
     *
     * @param string $id The ID of the subscription to find.
     * @return Subscription|null The found subscription or null if not found.
     */
    public function findById(string $id): ?Subscription {
        return $this->subscriptions[$id] ?? null;
    }

    /**
     * Renews a subscription by creating a new subscription with updated dates.
     *
     * @param Subscription $subscription The subscription to renew.
     * @return Subscription The newly created subscription.
     */
    public function renew(Subscription $subscription): Subscription {
        $newSubscription = new Subscription(
            uniqid('sub_', true),
            $subscription->getCustomerId(),
            $subscription->getBillingPeriod(),
            $subscription->getPrice(),
            new DateTime()
        );

        $this->save($newSubscription);

        return $newSubscription;
    }
}
