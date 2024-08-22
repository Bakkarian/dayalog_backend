<script setup>
  import DriverList from '@/Containers/DriverList.vue';
  import {
    XMarkIcon,
    BackwardIcon,
    ForwardIcon, 
    PauseIcon, 
    PlayIcon, 
  } from '@heroicons/vue/24/outline'
  import useDashboardMap from '@/composable/dashboardMap'
  import { Head, Link, router } from '@inertiajs/vue3';
  import { computed, watch } from 'vue';
  import dayjs from 'dayjs';

  import Layout from '@/Layouts/MainLayout.vue'
  import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';

    defineOptions({ layout: Layout })

    const props = defineProps(['devices', 'driver', 'drivers', 'device', 'history', 'historyPositions', 'currentHistoryPosition' ])

    const { 
        centerMapToDevice, 
        buildLocationFromDevice, 
        onMapLoaded, 
        addMarkerWithClickEvent, 
        plotHistory,
        clearPolylines,
    } = useDashboardMap()


    const locations = computed(()=> {
        return props.devices.map((device) =>  buildLocationFromDevice(device))
    })

    const selectedLocation = computed(() => locations.value.find(position => {
        return position.deviceData.id === props.device?.id
    } ))

    onMapLoaded(() => {
        locations.value.forEach((location) => {
            addMarkerWithClickEvent(location, (e, marker) => {
                router.visit(route('dashboard', { device : location.deviceData.id }), { except:['devices', 'historyPositions'],  preserveState: true });
            })
        })

        if(props.device) {
            centerMapToDevice(props.device.id);
        }
        
        if(props.history){
            console.log("history", props.history)
            plotHistory(props.historyPositions, props.currentHistoryPosition, 'history')
        }

    })

    watch(() => props.device, (device) => {
        if(device) {
            centerMapToDevice(device.id);
        }
            
            if(props.history && props.historyPositions){
                console.log("history", props.history)
                plotHistory(props.historyPositions, props.currentHistoryPosition, 'history')
            }
    })

    watch(() => props.history, (history) => {
        //TODO: Add a property to track if a map has been loaded
        if(history == 0){
            clearPolylines();
        }
    })


    const historyLink = computed(() => {
      
        return route('dashboard', {
            device: props.device?.id,
            history: true,
            historyFrom: dayjs('2024-08-13 00:00:00').startOf('day').unix(),
            historyTo: dayjs().unix()
        })
    })

    watch(()=> props, () => {
       // console.log("props", props)
    })
  </script>


<template>
    <Head title="Dashboard" />
    <div class="">
        <MapWithSideBar>
            <DriverList :locations="locations" />
        </MapWithSideBar>
        
    <!-- The selected location -->
     <div v-if="selectedLocation" class="absolute right-0 left-0 bottom-0 pb-4">
        
        <div class="w-fit mx-auto bg-white shadow-md rounded-md p-2">
            <div class="flex w-full header">
              <div class="flex w-full  justify-content-end align-items-end">
                   <div class="flex w-full justify-end">
                        <Link :only="['device']" :href="route('dashboard')" class="-m-2.5 p-2.5 inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"  preserve-state>
                            <span class="sr-only">Close device</span>
                            <XMarkIcon class="h-6 w-6 text-gray-500" aria-hidden="true" />
                        </Link>
                   </div>
              </div>
            </div>

            <div class="p-4 body">
                <div class="">
                   <div class="flex">

                        <div class="w-[300px]">
                            <br />
                            <p class="flex-auto">{{selectedLocation?.title}}</p>
                            <div class="flex my-2">
                                <p class="text-sm flex-1">Speed:</p>
                                <p class="text-sm flex-1 text-gray-400">{{ ((selectedLocation?.positionData?.speed ?? 1) * 1.852000).toFixed(1) }} Km/h</p>
                            </div>
                            <div class="flex my-2">
                                <p class="text-sm flex-1">Total Distance:</p>
                                <p class="text-sm flex-1 text-gray-400">{{(selectedLocation?.positionData?.attributes["totalDistance"]/1000).toFixed(2)}} Km</p>
                            </div>
                            <div class="flex my-2">
                                <p class="text-sm flex-1">Accuracy:</p>
                                <p class="text-sm flex-1 text-gray-400">{{(selectedLocation?.positionData?.accuracy ?? 0).toFixed(1)}}%</p>
                            </div>
                            <div v-if="!props.history" class="flex my-2 border-t">
                                <Link 
                                    :href="historyLink" 
                                    :except="['devices','historyPositions']"
                                    class="p-2 bg-gray-100 rounded-full mt-2 hover:bg-green-400"
                                    preserve-state
                                    ><div class="h-5 w-5">
                                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ReplayIcon"><path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"></path></svg>
                                    </div>
                                </Link>
                            </div>
                        </div>

                        <div class="w-[300px]" v-if="props.history">
                            <input type="range" class="w-full" id="points" name="points" min="0" max="1000">
                            <br />
                            <div class="flex w-full justify-center space-x-2">

                              <div class="flex space-x-2">
                                    <button>
                                        <BackwardIcon class="h-5 w-5 rounded-full "></BackwardIcon>
                                    </button>
                                

                                    <button class="p-2 bg-gray-100 rounded-full ">
                                        <PlayIcon class="h-5 w-5"></PlayIcon>
                                    </button>
                                    <button class="p-2 bg-gray-100 rounded-full ">
                                        <PauseIcon class="h-5 w-5"></PauseIcon>
                                    </button>

                                    <button>
                                        <ForwardIcon class="h-5 w-5 rounded-full "></ForwardIcon>
                                    </button>
                              </div>
  
                            </div>
                        </div>

                   </div>
                </div>
            </div>
        </div>
    </div>

    </div>
  </template>


  