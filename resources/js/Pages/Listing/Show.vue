<template>

    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center justify-center">
            <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
                <img v-for="image in listing.images" :key="image.id" :src="image.src" alt="House Image">
            </div>
            <div v-else class="font-medium text-gray-500">
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
                    <label>Interest Rate {{interestRate}}%</label>
                    <input
                        v-model.number="interestRate" 
                        type="range" min="0" max="30" step="0.1" 
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                    
                    <label>Duration {{duration}} Year(s)</label>
                    <input 
                        v-model.number="duration"
                        type="range" min="1" max="35" step="1" 
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your Monthly Payment</div>
                        <Price :price="monthlyPayment" class="text-3-xl" />
                    </div>

                    <div class="mt-2 text-gray-500">

                        <div class="flex justify-between">
                            <div>Total to Be Paid</div> 
                            <div>
                                <Price :price="totalPaid" class="font-medium" />
                            </div> 
                        </div>

                        <div class="flex justify-between">
                            <div>Principle</div> 
                            <div>
                                <Price :price="listing.price" class="font-medium" />
                            </div> 
                        </div>

                        <div class="flex justify-between">
                            <div>Interest to Be Paid</div> 
                            <div>
                                <Price :price="totalInterest" class="font-medium" />
                            </div> 
                        </div>

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
    import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';

    import {ref} from 'vue'

    
    const props = defineProps({
        listing: Object,
    })
    
    const interestRate = ref(2.5)
    const duration = ref(25)

    const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration)
    

</script>