<?php

require_once __DIR__ . '/vendor/autoload.php';

use Ranjeet\Php\Enums\Price;
use Ranjeet\Php\Enums\BillingPeriod;
use Ranjeet\Php\Services\BillingService;
use Ranjeet\Php\Repositories\SubscriptionRepository;

// Dependency Injection
$subscriptionRepository = new SubscriptionRepository();
$billingService = new BillingService($subscriptionRepository);

// Create a monthly subscription for a customer
$subscription = $billingService->createSubscription(
    'cust_1',
    Price::MONTHLY->getPrice(),
    BillingPeriod::MONTHLY
);

// Generate a bill after expiration
try {
    $bill = $billingService->generateBill($subscription);
    echo "Invoice Number: " . $bill->getInvoiceNumber() . "\n";
    echo "Amount: $" . number_format($bill->getAmount(), 2) . "\n";
    echo "Due Date: " . $bill->getDueDate()->format('Y-m-d') . "\n";
} catch (\RuntimeException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Renew subscription when expired
if ($subscription->isExpired()) {
    $newSubscription = $billingService->renewSubscription($subscription);
    $newBill = $billingService->generateBill($newSubscription);
    echo "New Invoice Number: " . $newBill->getInvoiceNumber() . "\n";
}
