<script setup>
  import DeviceCard from '@/Containers/DeviceCard.vue';
  import DriverList from '@/Containers/DriverList.vue';
  import HistoryCard from '@/Containers/HistoryCard.vue';
  import Layout from '@/Layouts/MainLayout.vue'
  import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';
  import { Head } from '@inertiajs/vue3';

    defineOptions({ layout: Layout })

    const props = defineProps({
        device: Object,
        devices: Array
    })

  </script>


<template>
    <Head title="Dashboard" />
    <div>
        <MapWithSideBar>
            <template #aside>
              <DriverList />
            </template>

            <DeviceCard v-if="props.device" />
            
        </MapWithSideBar> 
    </div>
  </template>


  