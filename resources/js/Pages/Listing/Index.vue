<template>
    <div v-for="listing in listings" :key="listing.id">
        <div>
            <Link :href="`/listing/${listing.id}`">
                {{ listing.street }} - {{ listing.street_nr }} - {{ listing.city }}, for {{ listing.price }}
            </Link>
        </div>
    
        <div>
            <Link :href="`/listing/${listing.id}/edit`">Edit</Link>
        </div>

        <div>
            <Link :href="`/listing/${listing.id}`" method="Delete" as="button">Delete</Link>
        </div>

    </div>
</template>

<script setup>

    import {Link} from '@inertiajs/vue3'

    defineProps({
        listings: Array, 
    })
</script>