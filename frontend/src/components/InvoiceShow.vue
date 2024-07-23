<script setup lang="ts">
defineProps<{
    invoice?: App.Invoice
}>()
</script>

<template>
    <div v-if="invoice"
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <div class="flex flex-col gap-2">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Invoice no. {{ invoice.id }}
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                Vendor name: {{ invoice.vendor_name }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                User: {{ invoice.user?.name }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                The amount is $ {{ invoice.amount }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                Its due date is on {{ invoice.due_date }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
                Description: <span class="!text-gray-400">{{ invoice.description }}</span>
            </p>
            <p
                :class="['font-normal', invoice.paid ? 'text-green-700' : 'text-red-700', invoice.paid ? 'dark:text-green-400' : 'dark:text-red-400']">
                {{ invoice.paid ? 'It has been paid' : 'It has not been paid' }}
            </p>
        </div>
    </div>

</template>