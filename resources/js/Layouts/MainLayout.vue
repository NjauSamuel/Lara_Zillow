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

          <div class="text-gray-500 relative pr-2 py-2">

            <svg width="25px" height="25px" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M53.32 18.8c0-7.09 5.77-12.86 12.86-12.86s12.86 5.77 12.86 12.86s-5.77 12.86-12.86 12.86S53.32 25.9 53.32 18.8zm7.48 0c0 2.97 2.41 5.38 5.38 5.38c2.97 0 5.38-2.41 5.38-5.38c0-2.97-2.41-5.38-5.38-5.38c-2.97 0-5.38 2.42-5.38 5.38z" fill="#e2a610"></path><path d="M77.24 12.28s.57 2.27-2.06 3.51c-2.63 1.23-4.37.32-4.37.32c.47.8.75 1.71.75 2.7c0 2.97-2.41 5.38-5.38 5.38c-2.97 0-5.38-2.41-5.38-5.38c0-.3.07-1.43.55-2.37c-4.46 2.12-7.85.31-7.85.31c-.11.67-.18 1.36-.18 2.06c0 7.09 5.77 12.86 12.86 12.86S79.04 25.9 79.04 18.8c0-2.38-.66-4.61-1.8-6.52z" fill="#9e740b"></path><path d="M10.46 97.8c6.77-6.65 10.99-8.89 12.71-18.53c1.72-9.64.34-29.95 7.92-43.25C38.01 23.84 50.71 18.8 63.1 18.8c.3 0 .6.02.9.02c.3-.01.6-.02.9-.02c12.39 0 25.09 5.04 32.01 17.21c7.57 13.31 6.2 33.62 7.92 43.25c1.72 9.64 5.94 11.88 12.71 18.53c2.92 2.87 6.45 7.44 6.46 10.38c.01 2.94-1.49 4.01-5.06 5.51c-10.1 4.25-23.6 8.37-54.94 8.37s-44.84-4.12-54.94-8.37c-3.57-1.5-5.07-2.56-5.06-5.51c.01-2.93 3.54-7.5 6.46-10.37z" fill="#ffca28"></path><path d="M113.7 108.38c0-4.43-22.25-8.02-49.7-8.02s-49.7 3.59-49.7 8.02s22.25 9.72 49.7 9.72s49.7-5.29 49.7-9.72z" fill="#4e342e"></path><path d="M93.84 44.79c.37 1.41.68 2.82.93 4.2c1.27 7.06 1.04 14.3 1.61 21.45c.77 9.57 2.47 14.61 6.34 19.11c.51.59-.01 1.5-.78 1.38c-5.17-.79-9.32-1.58-14.05-4.7c-7.06-4.65-8.8-13.4-8.85-21.26c-.08-11.7.14-23.03-.79-27.33c-1.29-5.99-2.49-9.18-4.45-12.09c-2.99-4.44 8.62 1.72 10.44 3.09c5.07 3.83 7.98 9.99 9.6 16.15z" fill="#e2a610"></path><path d="M30.89 60.32c-.12-7.58-.06-15.42 2.96-22.38c1.81-4.16 4.88-7.91 8.8-10.24c3.08-1.83 9.34-3.85 11.59.3c.45.83.63 1.8.66 2.75c.08 3.31-1.64 6.37-3.31 9.23c-4.94 8.48-6.91 17.75-9.52 27.15c-1.07 3.88-2.43 7.75-4.76 11.03c-1.6 2.25-10.51 10.25-8.47 3.02C30.8 74.19 31 67.6 30.89 60.32z" fill="#fff59d"></path><path d="M73.09 106.82c-.01-1.72-.94-2.71-3.08-3.45c-4.44-1.53-10-1.25-13.24.49c-3.4 1.82-1.04 11.91 7.23 11.91s9.1-7.64 9.09-8.95z" fill="#e2a610"></path><path d="M33.25 91.79c-8.78 1.54-15.14 4.87-17.89 7.57c-2.18 2.13-2.18 3.81 1.66 2.06c2.89-1.32 12.15-4 20.26-4.81c13.93-1.4 22.53-1.43 23.96-1.4c3.35.07 3.63-2.51-3.14-3.42c-6.77-.9-16.07-1.53-24.85 0z" fill="#fff59d"></path><path d="M60.46 113.82c1.16.8 2.7 1.19 4 .65c1.3-.54 2.14-2.19 1.5-3.44c-.25-.49-.68-.86-1.11-1.2c-1.19-.93-2.51-1.69-3.91-2.25c-.55-.22-1.13-.42-1.73-.38c-.59.03-1.21.34-1.44.89c-.99 2.25.99 4.57 2.69 5.73z" fill="#fff59d"></path></g></svg>
            <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
              {{notificationCount}}
            </div>
          </div>
          
          <Link class="text-sm text-gray-800 dark:text-gray-400 relative pr-6" :href="route('realtor.listing.index')">
            {{ user }}
            <div class="absolute right-0 top-1">
              <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFFFFF;" d="M256,508C117.04,508,4,394.96,4,256S117.04,4,256,4s252,113.04,252,252S394.96,508,256,508z"></path> <path style="fill:#D6D6D6;" d="M256,8c136.752,0,248,111.248,248,248S392.752,504,256,504S8,392.752,8,256S119.248,8,256,8 M256,0 C114.608,0,0,114.608,0,256s114.608,256,256,256s256-114.608,256-256S397.392,0,256,0L256,0z"></path> <g> <ellipse style="fill:#0BA4E0;" cx="256" cy="175.648" rx="61.712" ry="60.48"></ellipse> <path style="fill:#0BA4E0;" d="M362.592,360.624c0-57.696-47.728-104.464-106.592-104.464s-106.592,46.768-106.592,104.464H362.592 z"></path> </g> </g></svg>
            </div>
          </Link>
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

  // The Notifications Count at the NavBar
  const notificationCount = computed(
    () =>Math.min(page.props.user.notificationCount, 99)
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
