import { ref } from 'vue'
import { acceptHMRUpdate, defineStore } from 'pinia'
import ky from 'ky'
import { useUserStore } from './user-store'
import router from '@/router'

export const useInvoiceStore = defineStore('invoice-store', () => {
    const invoices = ref<App.LaravelPaginator<App.Invoice>>()

    const isFetching = ref(false)

    async function fetchInvoices(url = 'http://localhost:8000/api/invoices') {
        if (useUserStore().user?.id) {
            isFetching.value = true

            invoices.value = await ky.get(url, {
                headers: {
                    'Authorization': `Bearer ${useUserStore().token}`
                }
            }).json<App.LaravelPaginator<App.Invoice>>().finally(() => {
                isFetching.value = false
            })
        } else {
            router.push({ name: 'home' })
        }
    }

    return { invoices, isFetching, fetchInvoices }
})

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useInvoiceStore, import.meta.hot))
}
