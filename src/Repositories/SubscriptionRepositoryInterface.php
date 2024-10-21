<?php

namespace Ranjeet\Php\Repositories;

use Ranjeet\Php\Models\Subscription;

/**
 * Interface SubscriptionRepositoryInterface
 *
 * Defines the contract for a subscription repository.
 * saving, retrieving, and renewing subscriptions.
 */
interface SubscriptionRepositoryInterface {
    /**
     * Saves a subscription to the repository.
     *
     * @param Subscription $subscription The subscription object to save.
     * @return void
     */
    public function save(Subscription $subscription): void;

    /**
     * Finds a subscription by its ID.
     *
     * @param string $id The ID of the subscription to find.
     * @return Subscription|null The found subscription or null if not found.
     */
    public function findById(string $id): ?Subscription;

    /**
     * Renews a subscription by creating a new subscription instance.
     *
     * @param Subscription $subscription The subscription to renew.
     * @return Subscription The newly created subscription object.
     */
    public function renew(Subscription $subscription): Subscription;
}
