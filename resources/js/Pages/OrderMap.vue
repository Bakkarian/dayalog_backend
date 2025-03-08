<script setup>
    import Layout from '@/Layouts/MainLayout.vue'
    import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';
    import useDashboardMap from '@/composable/dashboardMap'
    import { ArrowLeftIcon} from '@heroicons/vue/24/outline';
    import { MapPinIcon } from '@heroicons/vue/20/solid'

    import { Link } from '@inertiajs/vue3';
    import { computed } from 'vue';

    defineOptions({ layout: Layout })

    const { buildLocationFromDevice, onMapLoaded, addMarkerWithClickEvent, centerMapToPosition, createRouteWithPlaces, plotHistory } = useDashboardMap()

    const props = defineProps({
        order: {
            type: Object,
            required: true,
        },
        devices: {
            type: Object,
            required: true,
        },
        dispatches: {
            type: Object,
            required: true,
        },
        selectedDispatch : {
            type: Object,
            required: false,
        }
    })


    const locations = computed(()=> {
        return props.devices.map((device) =>  buildLocationFromDevice(device))
    })

    onMapLoaded(()=>{

        if(props.selectedDispatch){
            createRouteWithPlaces(props.selectedDispatch.origin, props.selectedDispatch.destination)
            plotHistory(props.selectedDispatch.devicePositions, 'history')
        }

        locations.value.forEach((location) => {
            addMarkerWithClickEvent(location, (e, marker) => {
                centerMapToPosition(marker.position.lat(),marker.position.lng())
            })
        })
    })
</script>
<template>
    <MapWithSideBar >
        <template #aside>
            <div class="mt-8 w-full h-fit overflow-y-auto bg-white h-40 shadow-lg rounded-md transition-all ease-in-out duration-300" >
                <ul>
                    <li v-for="dispatch in dispatches">
                        <Link :href="route('order.view-order-map', {order: order.id, dispatch: dispatch.id})">
                            <div class="block hover:bg-gray-50 cursor-pointer">
                                <div class="px-1 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                    <p class="truncate text-sm font-medium text-gray-900">
                                        {{ dispatch.origin }} to {{ dispatch.destination }}
                                    </p>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-gray-500">
                                            <!-- <ClockIcon class="mr-1.5 h-4 w-4 flex-shrink-0 text-gray-400" aria-hidden="true" /> -->
                                            {{ dispatch.status }}
                                        </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </Link>
                        <div v-if="selectedDispatch && selectedDispatch.id == dispatch.id" :class="true ? 'h-[420px]':'h-0'" class="overflow-hidden bg-gray-50 transition-all ease-in-out duration-300">
                            <div   div class="p-3 flex items-center border-b border-t">
                            <div class="animate__animated" :class="true ?'animate__fadeInRight':'animate__fadeOutUp'">
                            <Link href="#" class="rounded-full bg-white border p-1 text-gray-500 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                <ArrowLeftIcon class="h-5 w-5" aria-hidden="true" />
                            </Link>
                            </div>
                            <h5 class="text-md font-bold ml-4 animate__animated animate__delay-0.3s" :class="true ?'animate__fadeInRight':'animate__fadeOutUp'">{{ selectedDispatch.order_vehicle.vehicle.driver.bio_data.name }}</h5>
                            </div>
                            <ul role="list" class="space-y-6 p-3 overflow-hidden">
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-green-500 rounded-full">
                                        <div class="h-1.5 w-1.5 rounded-full bg-green-100 ring-1 ring-white"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                                        <span class="font-medium text-gray-900">{{dispatch.origin}}</span>, Pickup Point.
                                    </p>
                                        <time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">"  "</time>
                                </li>


                                <!-- todo: stops -->
                                <li v-for="stop in selectedDispatch.stops"  class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>

                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white rounded-full">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>

                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">Stop: 1</span> Mbarara town -
                                        <a href="#" class="text-blue-400">{{ stop.start.latitude }},{{ stop.start.longitude }} </a></p>
                                    <time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">11:14am</time>
                                </li>

                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>

                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <MapPinIcon class="h-6 w-6 text-blue-600" />
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span class="font-medium text-gray-900">{{ dispatch.destination}}.</span> Final Delivery Point.</p>
                                    <time datetime="2023-01-24T09:20" class="flex-none py-0.5 text-xs leading-5 text-gray-500">...</time>
                                </li>
                            </ul>
                            <div class="w-full p-3">
                                <button type="button" @click="true?'animate__fadeInDown':'animate__fadeOutUp'" class="animate__animated rounded-md w-full bg-[#002760] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">More Details</button>
                            </div>
                        </div>
                    </li>
                </ul>
             </div>
        </template>
  
    </MapWithSideBar>
</template>
