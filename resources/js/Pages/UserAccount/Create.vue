<template>

    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">

            <div>
                <label class="label" for="name">Your Name</label>
                <input type="text" id="name" class="input" v-model="form.name" />
                <div class="input-error" v-if="form.errors.name">{{ form.errors.name }}</div>
            </div>

            <div class="mt-4">
                <label class="label" for="email">E-Mail (Username)</label>
                <input type="text" id="email" class="input" v-model="form.email" />
                <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
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
                <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
            </div>

            <div class="mt-4">
                <label class="label" for="password_confirmation">Confirm Password</label>
                <div class="relative">
                    <!-- Password Input -->
                    <input :type="showPassword ? 'text' : 'password'" id="password_confirmation" class="input pr-10" v-model="form.password_confirmation" />

                    <!-- Toggle Button -->
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500" @click="togglePasswordVisibility">
                        <span v-if="showPassword">Hide</span>
                        <span v-else>Show</span>
                    </button>
                </div>
                <div class="input-error" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
            </div>

            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Create Account</button>
            </div>
        </div>
    </form>

</template>


<script setup>

    import {useForm} from '@inertiajs/vue3'
    import {ref} from 'vue'

    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    })

    // The above use form is a helper from Inertia. (It is not a native vue function)
    // Using the above useForm function, you can access errors through
    // form.errors.email

    const register = () => form.post(route('user-account.store'))

    // State to toggle password visibility
    const showPassword = ref(false)

    // Function to toggle password visibility
    const togglePasswordVisibility = () => {
        showPassword.value = !showPassword.value
    }

</script>
