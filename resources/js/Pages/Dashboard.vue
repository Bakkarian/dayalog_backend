<template>
    <Head title="Dashboard" />
    <div class="">
        <MapWithSideBar>
            <DriverList :locations="locations" />
        </MapWithSideBar>
        
    <!-- The selected location -->
     <div v-if="selectedLocation" class="absolute right-0 left-0 bottom-0 pb-4">
        <div class="w-[300px] mx-auto shadow-md rounded-md">

            <div class="p-4 bg-white">
                <div class="flex">
                    <p class="flex-auto">{{selectedLocation.title}}</p>
                    <button type="button" @click="selectedDevice = null" class="-m-2.5 p-2.5">
                        <span class="sr-only">Close device</span>
                        <XMarkIcon class="h-6 w-6 text-gray-500" aria-hidden="true" />
                    </button>
                </div>
                <br />
                <div class="flex my-2">
                    <p class="text-sm flex-1">Speed:</p>
                    <p class="text-sm flex-1 text-gray-400">{{ (selectedLocation.positionData.speed * 1.852000).toFixed(1) }} Km/h</p>
                </div>
                <div class="flex my-2">
                    <p class="text-sm flex-1">Total Distance:</p>
                    <p class="text-sm flex-1 text-gray-400">{{(selectedLocation.positionData.attributes["totalDistance"]/1000).toFixed(2)}} Km</p>
                </div>
                <div class="flex my-2">
                    <p class="text-sm flex-1">Accuracy:</p>
                    <p class="text-sm flex-1 text-gray-400">{{(selectedLocation.positionData.accuracy).toFixed(1)}}</p>
                </div>
                <div class="flex my-2 border-t">
                    <a href="" class="p-2 bg-gray-100 rounded-full mt-2 hover:bg-green-400" title="History"><BackwardIcon class="h-5 w-5"></BackwardIcon></a>
                </div>
            </div>
        </div>
    </div>

    </div>
  </template>


  <script setup>
  import DriverList from '@/Containers/DriverList.vue';
  import {
    XMarkIcon,
    BackwardIcon
  } from '@heroicons/vue/24/outline'
  import useDashboardMap from '@/composable/dashboardMap'
  import { Head } from '@inertiajs/vue3';
  import { computed } from 'vue';

  import Layout from '@/Layouts/MainLayout.vue'
  import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';

  defineOptions({ layout: Layout })

    const props = defineProps(['devices', 'driver', 'drivers', 'selectedDeviceId' ])
    const { selectedDevice, buildLocationFromDevice, onMapLoaded, addMarkerWithClickEvent, centerMapToPosition } = useDashboardMap()

    const locations = computed(()=> {
        return props.devices.map((device) =>  buildLocationFromDevice(device))
    })

    const selectedLocation = computed(() => locations.value.find(position => {
        return position.deviceData.id === selectedDevice.value
    } ))

    onMapLoaded(() => {
        locations.value.forEach((location) => {
            addMarkerWithClickEvent(location, (e, marker) => {
                centerMapToPosition(marker.position.lat(),marker.position.lng())
                selectedDevice.value = marker.markerId
            })
        })
    })

  </script>
