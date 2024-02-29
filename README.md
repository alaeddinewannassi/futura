# Futura: Insurance Management System

This Symfony project is designed to manage insurance subscriptions for health, vehicle, and housing.

## Features

- **Subscription Plans (Packs)**: Create, update, and delete subscription plans for health, vehicle, and housing insurance.
- **Pack Categories**: Organize subscription plans into categories for easy management.
- **Insurance Guarantees**: Define specific guarantees and coverage details for each subscription plan.
- **User Management**: Basic user authentication and authorization for managing subscription plans.

## Requirements

- PHP 7.4 or higher
- Composer
- Symfony CLI

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/alaeddinewannassi/futura.git

2. Navigate into the project directory:
    ```bash
   cd futura
3. Install dependencies using Composer:
    ```bash
   composer install
4. Configure your environment variables by copying the .env file:
    ```bash
   cp .env.test .env
5. Load sample data (optional):
    ```bash
   php bin/console doctrine:fixtures:load
6. Generate SSH keys (optional, if you use JWT authentication):
    ```bash
   mkdir -p config/jwt
   openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
   openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

## Usage
Start the Symfony development server:
```bash
symfony server:start
```
Open your web browser and visit http://localhost:8000 to access the application.

## Running Tests
To execute tests, run:
```bash
symfony server:start
```

## Additional Information
For more information on Symfony commands and best practices, refer to [The Symfony Documentation](https://symfony.com/doc/current/index.html).


