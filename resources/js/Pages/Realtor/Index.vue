<template>
    <h1 class="text-3xl mb-4 inline mr-5">Your Listings</h1>
    <Link :href="route('realtor.listing.create')" class="btn-primary"> + New Listing </Link>


    <section>
        <RealtorFilters :filters="filters"/>
    </section>

    <Box v-if="!listings.data.length" class="flex min-h-[60vh] items-center justify-center">
      Your Listings Will Appear In This Page! 
    </Box>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed': listing.deleted_at}" >
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between relative">
                
                <div :class="{'opacity-25' : listing.deleted_at}">

                    <div v-if="listing.sold_at != null" class="text-lg absolute bg-green-500 font-bold text-white top-0 left-0 rounded-md px-1">Sold</div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" class="text-gray-500"/>
                </div>

                <section>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a 
                            v-if="!listing.deleted_at"
                            class="btn-outline text-xs font-medium"                 
                            :href="route('listing.show', { listing: listing.id })" 
                            target="_blank"
                        >Preview</a>
                        <Link class="btn-outline text-xs font-medium" 
                            :href="route('realtor.listing.edit', { listing: listing.id})">Edit</Link>
                        
                        
                        <Link 
                            v-if="!listing.deleted_at"
                            class="btn-outline text-xs font-medium" 
                            :href="route('realtor.listing.destroy', { listing: listing.id })" 
                            as="button" method="delete"
                            >                        
                            Delete
                        </Link>
                        <Link v-else class="btn-outline text-xs font-medium" 
                            :href="route('realtor.listing.restore', {listing: listing.id})"
                            as="button" 
                            method="put"
                        >
                            Restore
                        </Link>


                    </div>

                    <div class="mt-2">
                        <Link 
                            :href="route('realtor.listing.image.create', { listing: listing.id })" 
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Images ({{ listing.images_count }})
                        </Link>
                    </div>

                    <div class="mt-2">
                        <Link 
                            :href="route('realtor.listing.show', { listing: listing.id })" 
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length" class="w-full flex justify-center my-4">
        <Pagination :links="listings.links"/>
    </section>
</template>

<script setup>
    import Box from '@/Components/UI/Box.vue'
    import Price from '@/Components/Price.vue'
    import ListingSpace from '@/Components/ListingSpace.vue'
    import ListingAddress from '@/Components/ListingAddress.vue'
    import { Link } from '@inertiajs/vue3'
    import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
    import Pagination from '@/Components/UI/Pagination.vue'

    const props = defineProps({
        listings: Array,
        filters: Object
    });

</script>
