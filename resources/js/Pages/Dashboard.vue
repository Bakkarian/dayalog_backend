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
            </div>
        </div>
    </div>

    </div>
  </template>


  <script setup>
  import { ref} from 'vue'
  import DriverList from '@/Containers/DriverList.vue';
  import useTraccar from "@/composable/traccar"

  import {

    XMarkIcon,
  } from '@heroicons/vue/24/outline'
  import useDashboardMap from '@/composable/dashboardMap'
  import { Head } from '@inertiajs/vue3';
  import { computed, watch } from 'vue';

  import Layout from '@/Layouts/MainLayout.vue'
  import MapWithSideBar from '@/Layouts/MapWithSideBar.vue';

  defineOptions({ layout: Layout })

  const props = defineProps(['devices', 'driver', 'drivers', 'selectedDeviceId' ])
  const { positions : tracarPositions } = useTraccar();
  const {
    googleMap,
    loaded,
    addMarker,
    updateMarker,
    centerMapToPosition,
    selectedDevice
   } = useDashboardMap()

  let loadingList = ref(true)



  setTimeout(function(){
    let element = document.getElementById("driver-list")
    element?.classList?.remove("h-40")
    element?.classList?.add("h-[85%]")
    loadingList.value = false;
  },1000)


  const locations = computed(()=> {
    return props.devices.map((device => {
        // console.log(device.last_position)
            let latestPosition = tracarPositions.value.find(position => position.deviceId === device.id)
            if(!latestPosition){
                latestPosition = device.last_position
            }

            return  {
            position: { lat: latestPosition?.latitude, lng: latestPosition?.longitude },
            title: device.name,
            status: device.status,
            positionData: latestPosition,
            deviceData: device,
        };
    }));
  })

  const selectedLocation = computed(() => locations.value.find(position => {
    return position.deviceData.id === selectedDevice.value
  } ))


 //When the map loads load available locations
  watch(loaded, (newLoaded) => {
    if(newLoaded){
        locations.value.forEach((newLocation, i) => {
                if (newLocation.position.lat!==undefined && newLocation.title.toLowerCase()!=='ivan tracker') {
                    newLocation.id = newLocation.deviceData.id
                    const marker = addMarker(newLocation)
                    marker.addListener('click', (e) => {
                        centerMapToPosition(marker.position.lat(),marker.position.lng())
                        selectedDevice.value = marker.markerId
                    });

                }
            });
    }
  })
    // watch works directly on a ref
  watch(locations ,(newLocations, oldLocations) => {
    if(googleMap.value){
        newLocations.forEach((newLocation, i) => {
            if (newLocation.title.toLowerCase()!=='ivan tracker') {
                updateMarker(newLocation, newLocation.deviceData.id)
            }
        });
    }
  })

  </script>
