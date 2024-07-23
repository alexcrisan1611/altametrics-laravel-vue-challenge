<div class="relative overflow-x-auto rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Vendor name
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Due date
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Payment status
                </th>
                <th scope="col" class="px-6 py-3">
                    Details
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($invoices as $invoice)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $invoice->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $invoice->vendor_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $invoice->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        $ {{ $invoice->amount }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $invoice->due_date->format('M d Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $invoice->description }}
                    </td>
                    <td class="px-6 py-4 {{ $invoice->paid ? 'text-green-700' : 'text-red-700' }}">
                        {{ $invoice->paid ? 'Paid' : 'Not paid' }}
                    </td>
                    <td>
                        <a href="{{ route('invoices.show', ['invoice' => $invoice]) }}" type="button"
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Details
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($invoices->hasPages())
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($invoices->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $invoices->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($invoices->hasMorePages())
                <a href="{{ $invoices->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div
            class="px-4 py-1 sm:flex-1 sm:flex sm:items-center sm:justify-between text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $invoices->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $invoices->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $invoices->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($invoices->onFirstPage())
                        <span>
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $invoices->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($invoices->hasMorePages())
                        <a href="{{ $invoices->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-r-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </a>
                    @else
                        <span>
                            <span
                                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    @endif
</div>
