@extends('layout')

@section('title', 'Invoices totals')

@section('content')
    <section>
        <form method="get">
            <div>
                <label for="total-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Date for totals calculation
                </label>

                <input type="date" id="total-date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="date" value="{{ request()->get('date') }}" required />
            </div>

            <button type="submit"
                class="mt-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Calculate{{ request()->get('date') ? ' again' : '' }}</button>

            @php
                $randomInvoice = App\Models\Invoice::inRandomOrder()->first();
            @endphp
        </form>

        <button id="suggestion-button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Suggestion:
            {{ $randomInvoice->due_date->format('M d Y') }}
        </button>

        @if ($total)
            <div
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    We have a total for you!
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">The total for
                    {{ \Illuminate\Support\Carbon::parse(request()->get('date'))->format('M d Y') }} is
                    <span class="!text-green-700">$ {{ $total }}</span>
                </p>
            </div>
        @endif

        <script>
            document.querySelector('#suggestion-button').addEventListener('click', () => {
                document.querySelector('#total-date').value = "{{ $randomInvoice->due_date->format('Y-m-d') }}"
            })
        </script>
    </section>
@endsection
