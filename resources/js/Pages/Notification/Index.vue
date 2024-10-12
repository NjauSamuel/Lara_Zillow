<template>
    <h1 class="text-3xl mb-4">Your Notifications</h1>

    <section v-if="notifications.data.length" class="text-gray-700 dark:text-gray-300 min-h-[60vh]">
        <div v-for="notification in notifications.data" :key="notification.id" class="border-b dark:border-gray-200 border-gray-800 py-4 flex justify-between items-center">
            <div>

                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer <Price :price="notification.data.amount" /> for 
                    <Link :href="route('realtor.listing.show', {listing: notification.data.listing_id})" class="text-indigo-600 dark:text-indigo-400">
                        Listing
                    </Link>
                    was made. 
                </span>
                
            </div>            
            <div>
                <Link v-if="!notification.read_at" 
                    class="btn-outline text-xs font-medium uppercase" 
                    :href="route('notification.seen', {notification: notification.id} )"
                    as="button"
                    method="put"
                >
                    Mark as Read
                </Link>
            </div>
        </div>
    </section>

    <div v-if="!notifications.data.length" class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center">
        No Notifications yet. 
    </div>

    <section v-if="notifications.data.length" class="w-full flex justify-center">
        <Pagination :links="notifications.links"/>
    </section>
</template>


<script setup>

    import Price from '@/Components/Price.vue'
    import { Link } from '@inertiajs/vue3';
    import Pagination from '@/Components/UI/Pagination.vue'

    defineProps({
        notifications: Object
    })
</script>
