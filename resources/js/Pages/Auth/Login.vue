<template>

    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="email">E-Mail (Username)</label>
                <input type="text" id="email" class="input" v-model="form.email" />
                <div class="input-error">Pottential Errors</div>
            </div>

            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <div class="relative">
                    <!-- Password Input -->
                    <input :type="showPassword ? 'text' : 'password'" id="password" class="input pr-10" v-model="form.password" />

                    <!-- Toggle Button -->
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500" @click="togglePasswordVisibility">
                        <span v-if="showPassword">Hide</span>
                        <span v-else>Show</span>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
        </div>
    </form>

</template>


<script setup>

    import {useForm} from '@inertiajs/vue3'
    import {ref} from 'vue'

    const form = useForm({
        email: null,
        password: null,
    })

    const login = () => form.post(route('login.store'))

    // State to toggle password visibility
    const showPassword = ref(false)

    // Function to toggle password visibility
    const togglePasswordVisibility = () => {
        showPassword.value = !showPassword.value
    }

</script>
