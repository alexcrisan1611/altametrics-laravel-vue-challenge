# Altametrics Job Test Backend

Welcome to my backend documentation!

## Getting Started

### First-time Actions

To get started, make sure you've run the following commands inside the `backend` (current) folder:
- `docker compose up -d` gets the db up and running
- `cp .env.example .env` ensures the `.env` file is alright
- `composer install` installs the necessary PHP packages
- `pnpm i` installs the project's Node packages
- `php artisan migrate` runs the necessary migrations
- `php artisan db:seed` is going to seed all your necessary data in order to use the app
- `php artisan serve` will start a local server that will let you access the web app (make sure the URL is http://127.0.0.1:8000)

### Invoices Total

The invoices total feature makes it possible to see the total amount for all the invoices on a certain day. Its logic resides inside the invoice controller, at the `total()` method.

### Testing

This repo contains some basic tests for user authentication. See `tests\Feature\Http\Controllers\InvoiceControllerTest.php` for more details. You may run the tests (after seeding the database) with the `php artisan test` command.
