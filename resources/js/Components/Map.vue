<script setup>
 import useDashboardMap from '@/composable/dashboardMap'
 import { onMounted, onUnmounted } from 'vue';
 const { mapContainer, loadMap, resetMapStore } = useDashboardMap()

    onMounted(() => {
        console.log('map mounted')
        loadMap();
    })

    onUnmounted(()=> {
        console.log('map unmounted')
        resetMapStore();
    })

</script>

<template>
    <div ref="mapContainer" id="map" class="h-full w-full"></div>
</template>
