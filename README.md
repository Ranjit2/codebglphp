# PHP Billing System

A simple billing system implemented in PHP allows the management of subscriptions with different billing periods. This project includes functionalities for creating subscriptions, generating bills, and renewing subscriptions, all handled in memory without any database interaction.

## Features

- **Subscription Management**: Create, renew, and manage subscriptions.
- **Billing Periods**: Supports monthly and annual billing periods.
- **Code Coverage**: Includes a few tests using PHPUnit.

## Requirements

- PHP >= 8.1
- Composer
- PHPUnit for testing

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/Ranjit2/php-billing.git
   cd php-billing
# Install dependencies:
- composer install
- Navigate to the project directory:
- Run the application using cmd - php index.php

# Tests:
To run the test run ./vendor/bin/phpunit tests/SubscriptionTest.php and ./vendor/bin/phpunit tests/BillingServiceTest.php

