<script setup lang="ts">
import router from '@/router';
import { useUserStore } from '@/stores/user-store';
import { onMounted } from 'vue';

onMounted(() => {
  if (!useUserStore().user?.id) {
    router.push({ name: 'login' })
  }
})
</script>

<template>
  <div></div>
</template>