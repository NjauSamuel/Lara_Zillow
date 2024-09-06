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
                <input type="text" id="password" class="input" v-model="form.password" />
            </div>

            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
        </div>
    </form>

</template>


<script setup>

    import {useForm} from '@inertiajs/vue3'

    const form = useForm({
        email: null,
        password: null,
    })

    const login = () => form.post(route('login.store'))

</script>
