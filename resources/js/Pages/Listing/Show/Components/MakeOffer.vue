<template>

    <Box>
        <template #header>Make an Offer</template>
        <div>
            <form @submit.prevent="submitOffer">
                <input v-model.number="form.amount" type="text" class="input" />
                {{ form.errors.amount }}
                <input
                    v-model.number="form.amount"
                    type="range" :min="min" :max="max" step="100000" 
                    class="mt-1 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />

                <button type="submit" class="btn-outline w-full mt-2 text-sm">Make an Offer</button>
            </form>
        </div>

        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>

            <div>
                <Price :price="difference" />
            </div>

        </div>
    </Box>

</template>

<script setup>

    import Box from '@/Components/UI/Box.vue';
    import Price from '@/Components/Price.vue'
    import {useForm} from '@inertiajs/vue3'
    import { computed, watch } from 'vue'
    import { debounce } from 'lodash';

    const props = defineProps({
        listingId: Number,
        price: Number
    })

    const form = useForm({
        amount: props.price
    })

    // Method to submit the form
    const submitOffer = () => form.post(
        route('listing.offer.store', {listing: props.listingId}),
        {
            preserveScroll: true,
            preserveState: true,
        },
    )
    

    const difference = computed(() => form.amount - props.price)

    // For the maximum and minimum values of the sliders. 
    const min = computed(() => (Math.round((props.price / 2) / 1_000_000) * 1_000_000) + (props.price % 1_000_000));
    const max = computed(() => props.price * 2)

    // The funciton below doesn't have to be explicitly imported, same as the defineProps function
    // To emit an event, you have to assign the result of the emited call to a variable
    const emit = defineEmits(['offerUpdated'])

    watch(
        () => form.amount, 
        debounce((value) => emit('offerUpdated', value), 200),
    )
</script>
