<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input 
                    v-model.number="filterForm.priceFrom"
                    type="text" placeholder="Price From" class="input-filter-l w-28"
                />
                <input 
                    v-model.number="filterForm.priceTo"
                    type="text" placeholder="Price To" class="input-filter-r w-28"
                />
            </div>

            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.beds" class="input-filter-l w-28" >
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
                <select v-model="filterForm.baths" class="input-filter-r w-28">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.areaFrom" type="text" placeholder="Area From" class="input-filter-l w-28" />
                <input v-model.number="filterForm.areaTo" type="text" placeholder="Area To" class="input-filter-r w-28"/>
            </div>

            <button type="submit" class="btn-normal">Filter</button>
            <button type="reset" @click="clear">Clear</button>
        </div>
        
    </form>
</template>

<script setup>

    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({filters: Object})

    const filterForm = useForm({
        priceFrom: props.priceFrom ?? null,
        priceTo: props.priceTo ?? null,
        beds: props.beds ?? null,
        baths: props.baths ?? null,
        areaFrom: props.areaFrom ?? null,
        areaTo: props.areaTo ?? null,
    })

    const filter = () => {
        filterForm.get(
            route('listing.index'),
            {
                preserveState: true,
                preserveScroll: true,
            }
        )
    }

    const clear = () => {
        filterForm.priceFrom = null
        filterForm.priceTo = null
        filterForm.beds = null
        filterForm.baths = null
        filterForm.areaFrom = null
        filterForm.areaTo = null
    }

</script>
