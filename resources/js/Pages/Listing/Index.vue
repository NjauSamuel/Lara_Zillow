<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <Link :href="route('listing.show', {listing: listing.id})">
                    {{ listing.street }} - {{ listing.street_nr }} - {{ listing.city }}, for {{ listing.price }}
                </Link>
            </div>
        
            <div>
                <Link :href="route('listing.edit', listing.id)">Edit</Link>
            </div>

            <div>
                <Link :href="route('listing.destroy', listing.id)" method="Delete" as="button">Delete</Link>
            </div>

        </Box>
    </div>
</template>

<script setup>

    import {Link} from '@inertiajs/vue3'
    import Box from '@/Components/UI/Box.vue'

    defineProps({
        listings: Array, 
    })
</script>