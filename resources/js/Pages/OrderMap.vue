<script setup>
    import Layout from '@/Layouts/MainLayout.vue'
    import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';
    import useDashboardMap from '@/composable/dashboardMap'
import { computed } from 'vue';

    defineOptions({ layout: Layout })

    const { selectedDevice, buildLocationFromDevice, onMapLoaded, addMarkerWithClickEvent, centerMapToPosition } = useDashboardMap()

    const props = defineProps({
        order: {
            type: Object,
            required: true,
        },
        devices: {
            type: Object,
            required: true,
        }
    })


    const locations = computed(()=> {
        return props.devices.map((device) =>  buildLocationFromDevice(device))
    })

    onMapLoaded(()=>{
        locations.value.forEach((location) => {
            addMarkerWithClickEvent(location, (e, marker) => {
                centerMapToPosition(marker.position.lat(),marker.position.lng())
                selectedDevice.value = marker.markerId
            })
        })
    })
</script>
<template>
    <MapWithSideBar >
        <div class="mt-8 w-full overflow-y-auto bg-white h-40 shadow-lg rounded-md transition-all ease-in-out duration-300" >
            <ul>
                <li v-for="order_vehicle in order.order_vehicles">
                    <div class="block hover:bg-gray-50 cursor-pointer">
                        <div class="px-1 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                            <p class="truncate text-sm font-medium text-gray-900">
                                {{ order_vehicle.vehicle.driver.bio_data.name }} ({{ order_vehicle.vehicle.number_plate }})
                            </p>

                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p class="flex items-center text-sm text-gray-500">
                                    <!-- <ClockIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" /> -->
                                    {{ order_vehicle.dispatches.length }} Trips
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </MapWithSideBar>
</template>
