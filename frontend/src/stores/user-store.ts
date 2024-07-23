import { ref } from 'vue'
import { acceptHMRUpdate, defineStore } from 'pinia'
import ky from 'ky'
import { z } from 'zod'
import router from '@/router'

export const useUserStore = defineStore('user-store', () => {
  const user = ref<App.User>()

  const token = ref<string>()

  // Zod credentials schema.
  const loginSchema = z.object({
    email: z.coerce.string().email(),
    password: z.string(),
  })

  // Credentials object.
  const loginForm = ref<App.User>({
    email: 'me@altametrics.com',
    password: 'password',
  })

  async function login() {
    // Validating credentials with Zod.
    const loginValidation = loginSchema.safeParse(loginForm.value)

    if (loginValidation.success) {
      const json = await ky.post('http://localhost:8000/api/auth', {
        json: loginForm.value,
      }).json<{
        user: App.User,
        token: string,
      }>()

      user.value = json.user

      token.value = json.token

      router.push('invoices')
    }
  }

  return { user, token, loginForm, login }
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useUserStore, import.meta.hot))
}
