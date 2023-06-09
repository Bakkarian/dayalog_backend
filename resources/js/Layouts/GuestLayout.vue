<script setup>
    import logo from '@/assets/LOGO.png'
    import { usePage } from '@inertiajs/vue3';
    import { ref, onMounted, watch, computed } from 'vue';

    const component = computed(() => usePage().component)
    const image = ref("");


    function getRandomImage(){
        const images = [
            "https://images.pexels.com/photos/5471182/pexels-photo-5471182.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
            "https://images.pexels.com/photos/248412/pexels-photo-248412.jpeg?auto=compress&cs=tinysrgb&w=1600",
            "https://img.freepik.com/premium-vector/world-map-with-countries-borders_47243-900.jpg?w=2000",
            "https://img.freepik.com/premium-vector/location-travel-road-white-background-vector-illustration_547150-338.jpg?w=1380",
        ]
        const randomInt = Math.floor(Math.random() * images.length);
        return images[randomInt];
    }

    onMounted(() => {
        image.value = getRandomImage()
    });

    watch(component, async (newVal, oldVal) => {
        image.value = getRandomImage()
    });

</script>

<template>
    <div class="flex min-h-full flex-1">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <slot />
        </div>
      <div class="relative hidden w-0 flex-1 lg:block">
        <img class="absolute inset-0 h-full w-full object-cover" :src="image" alt="" />
        <img class="relative mx-auto opacity-40" :src=logo />
      </div>
    </div>
</template>
