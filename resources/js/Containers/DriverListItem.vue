<script setup>
import { computed, onMounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import useDashboardMap from '@/composable/dashboardMap';

const { device } = defineProps(['device'])
const location = device

const { addMarkerWithClickEvent, buildLocationFromDevice, traccarDevices  } = useDashboardMap()

const selectDevice = (deviceId) => {
    router.visit(
        route('dashboard', { device : deviceId }),
        { except:['devices', 'historyPositions' ],  preserveState: true, replace : true }
    );
}


onMounted(()=>{

    addMarkerWithClickEvent(buildLocationFromDevice(location), (e, marker) => {
        selectDevice(device.id)
    })
})

const liveLocation = computed(() => {
    return traccarDevices.value.find(traccarDevice => traccarDevice.id === device.id) || device
})


</script>

<template>

    <div @click="selectDevice(device.id)" class="flex p-4 cursor-pointer items-center">
        <div
            class="flex items-center justify-center rounded-full h-[40px] w-[40px] bg-gray-400 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
            </svg>
        </div>
        <div class="flex-auto ml-2">
            <p class="text-sm">{{ location?.name }}</p>
            <p class="text-sm font-bold"
                :class="liveLocation.status.toLowerCase()==='online'?'text-green-500':'text-red-600'">
                {{ liveLocation.status.toLowerCase()!=='online'?'Parked':'Online' }}</p>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-6 h-6"
                :class="liveLocation['attributes']['batteryLevel']>50?'text-green-400':'text-orange-400'">
                <path fill-rule="evenodd"
                    d="M3.75 6.75a3 3 0 00-3 3v6a3 3 0 003 3h15a3 3 0 003-3v-.037c.856-.174 1.5-.93 1.5-1.838v-2.25c0-.907-.644-1.664-1.5-1.837V9.75a3 3 0 00-3-3h-15zm15 1.5a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-6a1.5 1.5 0 011.5-1.5h15zM4.5 9.75a.75.75 0 00-.75.75V15c0 .414.336.75.75.75H18a.75.75 0 00.75-.75v-4.5a.75.75 0 00-.75-.75H4.5z"
                    clip-rule="evenodd"/>
            </svg>
            <small>
                {{ liveLocation["attributes"]["batteryLevel"] }}{{
                    liveLocation["attributes"]["batteryLevel"] ? '%' : ''
                }}</small>
        </div>
    </div>
  

</template>