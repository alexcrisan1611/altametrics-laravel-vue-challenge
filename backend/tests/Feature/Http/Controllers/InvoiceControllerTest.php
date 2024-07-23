<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    /**
     * Index page test for authenticated users.
     */
    public function test_auth_index_page(): void
    {
        Auth::loginUsingId(User::inRandomOrder()->first()->id);

        $response = $this->get(route('invoices.index'));

        $response->assertStatus(200);
    }

    /**
     * Test total feature.
     */
    public function test_total_page(): void
    {
        $response = $this->get(route('invoices.total', [
            'date' => Invoice::inRandomOrder()->first()->created_at->format('Y-m-d'),
        ]));

        $response->assertStatus(200);
    }
}
