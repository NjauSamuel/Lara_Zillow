<template>

    <Filters />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />

    </div>

    <div v-if="listings.data.length" class="w-full flex justify-center my-4">
      <Pagination :links="listings.links"></Pagination>
    </div>
  </template>
  
  <script setup>

    import Listing from '@/Pages/Listing/Index/Components/Listing.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Filters from '@/Pages/Listing/Index/Components/Filters.vue';

    defineProps({
        listings: Object, 
    })
  </script>