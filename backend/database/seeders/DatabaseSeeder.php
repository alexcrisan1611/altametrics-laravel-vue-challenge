<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::where('email', 'me@altametrics.com')->doesntExist()) {
            User::create([
                'name' => 'Default Account',
                'email' => 'me@altametrics.com',
                'password' => bcrypt('password'),
            ]);
        }

        User::factory(10)->create();

        $this->call([
            InvoiceSeeder::class,
        ]);
    }
}
