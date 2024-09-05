<template>
    <span>{{ formattedPrice }}</span>
</template>

<script setup>
    import {computed} from 'vue'

    const props = defineProps({
        price: [Number, String],
    })

    const formattedPrice = computed(() => {
        const price = Math.ceil(Number(props.price)); // Truncate to the next whole number
        
        return price.toLocaleString('en-US', {
            style: 'currency',
            currency: 'KES',
            maximumFractionDigits: 0,  // No decimal places
        });
    });

</script>
