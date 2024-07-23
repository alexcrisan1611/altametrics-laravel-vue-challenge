<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { useUserStore } from './stores/user-store';

const userStore = useUserStore()
</script>

<template>
  <div class="px-16 py-4 grid grid-cols-10">
    <div class="col-span-2 font-semibold text-xl">
      <img alt="Vue logo" class="w-40 mb-4" src="@/assets/logo.svg" width="125" height="125" />

      <nav class="flex flex-col gap-4">
        <span class="text-gray-700 dark:text-gray-300">Menu</span>
        <div class="text-lg ms-4 flex flex-col gap-2">
          <template v-if="userStore.user?.id">
            <RouterLink :to="{ name: 'home' }">Home</RouterLink>
            <RouterLink :to="{ name: 'invoices' }">Invoices</RouterLink>
          </template>
          <RouterLink v-else :to="{ name: 'login' }">Login</RouterLink>
        </div>
      </nav>
    </div>

    <main class="col-span-8 rounded mx-4 px-4 py-2 my-2 bg-gray-100 dark:bg-gray-800">
      <RouterView />
    </main>
  </div>
</template>
