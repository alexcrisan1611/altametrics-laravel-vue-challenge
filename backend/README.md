# Altametrics Job Test Backend

Welcome to my backend documentation!

## Getting Started

### Necessary Software

Here's the set of software you need to run this project:

- Docker
- Composer (PHP package manager)
- Node
- PNPM (Node package manager)
- PHP

### First-time Actions

For your convenience, in order to get the backend ready quickly, you can try running the following command in PowerShell (it's an aggregate of all the commands below):

```
docker compose up -d; cp .env.example .env; composer install; php artisan migrate; php artisan db:seed; php artisan serve
```

To get started, make sure you've run the following commands inside the `backend` (current) folder:
- `docker compose up -d` gets the db up and running
- `cp .env.example .env` ensures the `.env` file is alright
- `composer install` installs the necessary PHP packages
- `php artisan migrate` runs the necessary migrations
- `php artisan db:seed` is going to seed all your necessary data in order to use the app
- `php artisan serve` will start a local server that will let you access the web app (make sure the URL is http://127.0.0.1:8000)

Now you can go over to the frontend side.

### Invoices Total

The invoices total feature makes it possible to see the total amount for all the invoices on a certain day. Its logic resides inside the invoice controller, at the `total()` method.

### Testing

This repo contains some basic tests for user authentication. See `tests\Feature\Http\Controllers\InvoiceControllerTest.php` for more details. You may run the tests (after seeding the database) with the `php artisan test` command.
