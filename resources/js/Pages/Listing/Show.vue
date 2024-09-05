<template>

    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <div class="font-medium text-gray-500">
                No Images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic Info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold"></Price>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>

            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label>Interest Rate (2.5%)</label>
                    <input 
                        type="range" min="0.1" max="30" step="0.1" 
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                    
                    <label>Duration (25 years)</label>
                    <input 
                        type="range" min="1" max="35" step="1" 
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your Monthly Payment</div>
                        <Price :price="500" class="text-3-xl" />
                    </div>
                    
                </div>
            </Box>
        </div>
    </div>

</template>

<script setup>

    import ListingAddress from '@/Components/ListingAddress.vue'
    import Box from '@/Components/UI/Box.vue'
    import ListingSpace from '@/Components/ListingSpace.vue';
    import Price from '@/Components/Price.vue';

    defineProps({
        listing: Object,
    })

</script>