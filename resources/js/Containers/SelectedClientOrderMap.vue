
<script setup>
    import useDashboardMap from '@/composable/dashboardMap';
import {
        StarIcon,
        MapPinIcon,
        CogIcon,
        ArrowUturnUpIcon,
        StopCircleIcon
    } from '@heroicons/vue/24/outline'
    import { usePage } from '@inertiajs/vue3';
    import { computed, onMounted, ref } from 'vue';

    const { loaded, onMapLoaded, resetMapStore, mapContainer, loadMap } = useDashboardMap()


    const page = usePage();
    const order = computed(() => page.props.selectedOrder)

    const orderVehicles = computed(() => page.props.selectedOrder.order_vehicles)

    const dispatches = computed(() => orderVehicles.value.map((orderVehicle) => orderVehicle.active_dispatches[0]).filter( Boolean )  )
    console.log("ewewewe",dispatches.value)

    let selectedDispatch = ref("")

    const tabs = [
        { name: 'Order Details', href: '#', current: false },
        { name: 'Vehicle', href: '#', current: true },
        { name: 'Driver Information', href: '#', current: false },
    ]


    onMounted(() => {
        loadMap({
            zoom: 12
        });
    })

</script>

<template>
          <div class="relative h-96  ">

                    <div ref="mapContainer" id="map" class="text-center  bg-red-200  h-96 "></div>

                    <div class="absolute bottom-0 left-0 right-0 mb-6 mx-12 p-3 bg-white rounded-lg shadow-lg">
                        <div class="flex justify-between">
                            <div>
                                <div class="flex">

                                    <div class="flex">

                                        <select class="text-gray-400 text-xs" v-model="selectedDispatch">
                                            <option value="" selected>Select Trip</option>
                                            <option v-for="dispatch in dispatches" :key="dispatch.id" >
                                                {{ dispatch.origin  }} to {{ dispatch.destination }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex">
                                    <MapPinIcon class="w-5 h-5 text-blue-500"></MapPinIcon>
                                    <div>
                                        <h5 class="text-sm">Current location</h5>
                                        <p class="text-gray-400 text-xs">Kampala, Uganda</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex">
                                    <CogIcon class="w-5 h-5 text-blue-500"></CogIcon>
                                    <div>
                                        <h5 class="text-sm">Speed</h5>
                                        <p class="text-gray-400 text-xs">34.5k/hr</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex">
                                    <ArrowUturnUpIcon class="w-5 h-5 text-blue-500"></ArrowUturnUpIcon>
                                    <div>
                                        <h5 class="text-sm">Km Left</h5>
                                        <p class="text-gray-400 text-xs">34.5km</p>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div class="flex">
                                    <StopCircleIcon class="w-5 h-5 text-blue-500"></StopCircleIcon>
                                    <div>
                                        <h5 class="text-sm">Last Stop</h5>
                                        <p class="text-gray-400 text-xs">1hr ago</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
</template>
