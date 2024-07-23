@extends('layout')

@section('title', 'Invoices')

@section('content')
    <section>
        <x-invoices-table :invoices="$invoices" />
    </section>
@endsection
