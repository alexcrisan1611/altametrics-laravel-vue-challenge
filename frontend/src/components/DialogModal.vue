<script setup lang="ts">
import { ref } from 'vue'
import CustomButton from './CustomButton.vue';

defineProps<{
    title: string
}>()

const dialogRef = ref<HTMLDialogElement | null>(null)

const openModal = () => {
    dialogRef.value?.showModal()
}

const closeModal = () => {
    dialogRef.value?.close()
}

const handleClose = () => {
    console.log('Modal closed')
}

defineExpose({
    openModal, closeModal, handleClose
})
</script>

<template>
    <dialog ref="dialogRef" @close="handleClose" class="rounded">
        <div class="px-4 py-2 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <slot></slot>
            <CustomButton class="mt-2" @click="closeModal">Close</CustomButton>
        </div>
    </dialog>
</template>
