<script setup lang="ts">
import CustomButton from '@/components/CustomButton.vue';
import DialogModal from '@/components/DialogModal.vue';
import InvoiceShow from '@/components/InvoiceShow.vue';
import { useInvoiceStore } from '@/stores/invoice-store';
import { useUserStore } from '@/stores/user-store';
import ky from 'ky';
import { onMounted, ref } from 'vue';

const invoiceStore = useInvoiceStore()

const dialogRef = ref<InstanceType<typeof DialogModal>>()

const selectedInvoice = ref<App.Invoice>()

async function selectInvoice(invoice: App.Invoice) {
  selectedInvoice.value = invoice

  await fetchInvoice()

  dialogRef.value?.openModal()
}

async function fetchInvoice() {
  selectedInvoice.value = await ky.get(
    `http://localhost:8000/api/invoices/${selectedInvoice.value?.id}`,
    {
      headers: {
        'Authorization': `Bearer ${useUserStore().token}`
      }
    }
  ).json<App.Invoice>()
}

onMounted(invoiceStore.fetchInvoices)
</script>

<template>
  <nav class="flex flex-row justify-between px-16 py-8 border-b-gray-900 dark:border-b-gray-100">
    <span class="text-2xl">Invoices</span>

    <div class="flex flex-row gap-4">
      <div class="h-12">
        <label for="default-search"
          class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </div>
          <input type="search" id="default-search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search" required />
          <button type="submit"
            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
      </div>

      <img class="w-12 h-12 rounded-full ring-2 dark:ring-gray-100 ring-gray-900"
        src="https://cdn.quasar.dev/img/avatar4.jpg" alt="Rounded avatar">
    </div>
  </nav>

  <div class="relative overflow-x-auto rounded-lg mx-8 my-2">
    <DialogModal title="Invoice" ref="dialogRef">
      <InvoiceShow :invoice="selectedInvoice" />
    </DialogModal>

    <table :class="['w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400', {
      'opacity-25': invoiceStore.isFetching
    }]">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            ID
          </th>
          <th scope="col" class="px-6 py-3">
            Vendor name
          </th>
          <th scope="col" class="px-6 py-3">
            User ID
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
        <tr v-for="invoice of invoiceStore.invoices?.data" :key="invoice.id"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ invoice.id }}
          </th>
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ invoice.vendor_name }}
          </th>
          <td class="px-6 py-4">
            {{ invoice.user_id }}
          </td>
          <td class="px-6 py-4">
            $ {{ invoice.amount }}
          </td>
          <td class="px-6 py-4">
            {{ invoice.due_date }}
          </td>
          <td class="px-6 py-4 truncate max-w-[20rem]" :title="invoice.description">
            {{ invoice.description }}
          </td>
          <td :class="['px-6 py-4', invoice.paid ? 'text-green-700' : 'text-red-700']">
            {{ invoice.paid ? 'Paid' : 'Not paid' }}
          </td>
          <td class="flex place-content-center">
            <button type="button" @click="selectInvoice(invoice)"
              class="py-2.5 px-5 my-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
              </svg>
            </button>

          </td>
        </tr>
      </tbody>
    </table>

    <div class="mt-2">
      <span class="me-2">Page {{ invoiceStore.invoices?.current_page }} of {{ invoiceStore.invoices?.last_page }}</span>

      <CustomButton title="First page" @click="invoiceStore.fetchInvoices(invoiceStore.invoices?.first_page_url)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
      </CustomButton>

      <CustomButton title="Next page" @click="invoiceStore.fetchInvoices(invoiceStore.invoices?.next_page_url)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
        </svg>
      </CustomButton>

      <span class="ms-2">{{ invoiceStore.invoices?.per_page }} invoices per page ({{ invoiceStore.invoices?.total }} in
        total)</span>
    </div>
  </div>
</template>
