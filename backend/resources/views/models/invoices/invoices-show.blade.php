@extends('layout')

@section('title', "Invoice no. {$invoice->id}")

@section('content')
    <section>
        <x-invoices-show :invoice="$invoice" />
    </section>
@endsection
