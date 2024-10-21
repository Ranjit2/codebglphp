<?php 

declare(strict_types=1);

namespace Ranjeet\Php\Models;

use DateTime;

class Bill {
    private DateTime $dueDate;
    private string $invoiceNumber;

    /**
     * Bill constructor.
     *
     * @param Subscription $subscription The subscription associated with this bill.
     * @param DateTime $billingDate The date when the bill is generated.
     */
    public function __construct(
        private Subscription $subscription,
        private DateTime $billingDate
    ) {
        $this->dueDate = $billingDate; 
        $this->invoiceNumber = $this->generateInvoiceNumber();
    }

    /**
     * Generates a unique invoice number.
     *
     * @return string The generated invoice number.
     */
    private function generateInvoiceNumber(): string {
        return sprintf(
            'INV-%s-%s',
            $this->billingDate->format('Ymd'),
            substr(uniqid(), -6)
        );
    }

    /**
     * Gets the invoice number.
     *
     * @return string The invoice number.
     */
    public function getInvoiceNumber(): string {
        return $this->invoiceNumber;
    }

    /**
     * Gets the amount due for the bill based on the subscription price.
     *
     * @return float The amount due for this bill.
     */
    public function getAmount(): float {
        return $this->subscription->getPrice();
    }

    /**
     * Gets the due date of the bill.
     *
     * @return DateTime The due date.
     */
    public function getDueDate(): DateTime {
        return $this->dueDate;
    }

    /**
     * Gets the subscription associated with this bill.
     *
     * @return Subscription The subscription instance.
     */
    public function getSubscription(): Subscription {
        return $this->subscription;
    }
}
