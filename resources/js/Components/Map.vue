<script setup>
 import useDashboardMap from '@/composable/dashboardMap'
 import { onMounted } from 'vue';
 const { mapContainer, loadMap } = useDashboardMap()

    onMounted(() => {
        loadMap();
    })

</script>

<template>
    <div ref="mapContainer" id="map" class="h-full w-full"></div>
</template>
