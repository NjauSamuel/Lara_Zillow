<template>
    <div>        
        You Need to Verify Your Email to access This service. 
    </div>

    <div>
        <Link :href="route('verification.send')" method="Post" as="button" class="text-indigo-600 dark:text-indigo-400">
            Resend Verification Email!</Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
