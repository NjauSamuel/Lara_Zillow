<template>

  <header class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-white w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('listing.index')"> Listings </Link>
        </div>

        <div class="text-xl text-indigo-800 dark:text-indigo-300 font-bold text-center">
          <Link :href="route('listing.index')"> LaraZillow </Link>
        </div>

        <div v-if="user" class="flex items-center gap-4">
          <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{ user }}</Link>
          <Link :href="route('realtor.listing.create')" class="btn-primary"> + New Listing </Link>
          <div>
            <Link :href="route('logout')" method="delete" as="button">Logout</Link>
          </div>          
        </div>
        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">Register</Link>
          <Link :href="route('login')">Sign-In</Link>
        </div>


      </nav>
    </div>
  </header>

  <!-- Dark mode toggle SVG -->
  <!-- & -->
  <!-- Light mode toggle SVG -->

  <svg v-if="isDarkMode" @click="toggleDarkMode" class="absolute top-24 right-4 w-8 h-8 cursor-pointer" width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#a)" fill="#ffffff"> <path d="M12 0a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0V1a1 1 0 0 1 1-1ZM4.929 3.515a1 1 0 0 0-1.414 1.414l2.828 2.828a1 1 0 0 0 1.414-1.414L4.93 3.515ZM1 11a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2H1ZM18 12a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1ZM17.657 16.243a1 1 0 0 0-1.414 1.414l2.828 2.828a1 1 0 1 0 1.414-1.414l-2.828-2.828ZM7.757 17.657a1 1 0 1 0-1.414-1.414L3.515 19.07a1 1 0 1 0 1.414 1.414l2.828-2.828ZM20.485 4.929a1 1 0 0 0-1.414-1.414l-2.828 2.828a1 1 0 1 0 1.414 1.414l2.828-2.828ZM13 19a1 1 0 1 0-2 0v4a1 1 0 1 0 2 0v-4ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Z"></path> </g> <defs> <clipPath id="a"> <path fill="" d="M0 0h24v24H0z"></path> </clipPath> </defs> </g></svg>
  <svg v-else @click="toggleDarkMode" class="absolute top-24 right-4 w-8 h-8 cursor-pointer icon"  width="64px" height="64px" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M785.334 194.943c174.789 174.787 174.789 459.179 0 633.967-174.787 174.787-459.178 174.787-633.967 0-13.206-13.205-26.22-28.336-39.807-46.314a19.672 19.672 0 0 1-2.223-20.012 19.777 19.777 0 0 1 16.54-11.442c98.838-6.698 191.601-48.753 261.234-118.386C530.853 489.014 546.472 258.475 423.392 96.51a19.553 19.553 0 0 1-2.249-19.981 19.554 19.554 0 0 1 16.54-11.497c129.587-8.759 256.325 38.583 347.651 129.911z" fill="#2577FF"></path><path d="M785.334 194.943c-14.266-14.268-29.484-27.325-45.354-39.399 151.302 175.925 143.723 442.269-22.987 608.98-121.85 121.85-307.044 190.195-461.161 142.154 60.038 35.511 140.886 47.603 167.101 50.984 129.417 13.067 263.464-29.816 362.401-128.753 174.789-174.787 174.789-459.179 0-633.966z" fill="#030504"></path></g></svg>
  

  <main class="container mx-auto p-4 w-full">

    <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-100 dark:bg-green-900 p-2">
      {{ flashSuccess }}
    </div>

    <slot>Default</slot>

  </main>

</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  import { usePage } from '@inertiajs/vue3'
  import { computed, ref, onMounted } from 'vue'

  const page = usePage()
  const flashSuccess = computed(
    () => page.props.flash.success
  )

  const user = computed(
    () => page.props.user?.name
  )

  // Dark mode state
  const isDarkMode = ref(false);

  // Function to toggle dark mode
  const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    if (isDarkMode.value) {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
    }
  };

  // Check user's preference on load
  onMounted(() => {
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      isDarkMode.value = true;
      document.documentElement.classList.add('dark');
    }
  });
  
</script>
