<script setup>
    import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';
    import Layout from '@/Layouts/MainLayout.vue'
    defineOptions({ layout: Layout })

    const props = defineProps({
        order: {
            type: Array,
            required: true,
        },
    })
</script>
<template>
    <MapWithSideBar >
        <div>Hello</div>
    </MapWithSideBar>
</template>
