<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Gate;
use Respect\Validation\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Invoice::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return $invoice->load('user:id,name');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    /**
     * Aggregate the amount of all invoices by the due date.
     */
    public function total(Request $request)
    {
        $date = $request->get('date');

        if ($date) {
            Gate::allowIf(Validator::date()->validate($date));
        }

        return Invoice::where('due_date', $request->get('date'))->sum('amount');
    }
}
