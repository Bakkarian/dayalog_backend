<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, watch } from 'vue';
import HistoryCard from './HistoryCard.vue';
import useDashboardMap from '@/composable/dashboardMap';
import dayjs from 'dayjs';
import { XMarkIcon  } from '@heroicons/vue/24/outline'


    const { buildLocationFromDevice, tracarPositions } = useDashboardMap()

    const props = computed(() => usePage().props)
    const history = computed(() => props.value.history)

    const device = computed(() => {
        return buildLocationFromDevice(props.value.device)
    })

    const historyLink = computed(() => {
        return route('dashboard', {
            device: device.value.id,
            history: true,
            historyFrom: dayjs().startOf('day').unix(),
            historyTo: dayjs().unix()
        })
    })

    const liveLocation = computed(()=>{
        return  tracarPositions.value.find(position => position.deviceId === props.value.device.id) || props.value.device.last_position
    })

</script>

<template>

<div class="absolute w-full right-0 left-0 bottom-0 pb-4"> 
                <div class="w-fit mx-auto bg-white shadow-md rounded-md p-2">
                    <div class="flex w-full header">
                    <div class="flex w-full  justify-content-end align-items-end">
                        <div class="flex w-full justify-end">
                                <Link 
                                    :only="['device']" 
                                    :href="route('dashboard')" 
                                    :except="['devices']"
                                    class="-m-2.5 p-2.5 inline-flex items-center justify-center rounded-md \
                                    text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none  \
                                    focus:ring-2 focus:ring-inset focus:ring-indigo-500" 

                                     preserve-state>
                                    <span class="sr-only">Close device</span>
                                    <XMarkIcon class="h-6 w-6 text-gray-500" aria-hidden="true" />
                                </Link>
                        </div>
                    </div>
                    </div>

                    <div class="p-4 body">
                        <div class="">
                        <div class="flex">
                                
                                <HistoryCard v-if="history" /> 
                                <div v-else class="w-[300px]">
                                    <br />
                                    <p class="flex-auto">{{device?.name}}</p>
                                    <div class="flex my-2">
                                        <p class="text-sm flex-1">Speed:</p>
                                        <p class="text-sm flex-1 text-gray-400">{{ ((liveLocation?.speed ?? 1) * 1.852000).toFixed(1) }} Km/h</p>
                                    </div>
                                    <div class="flex my-2">
                                        <p class="text-sm flex-1">Total Distance:</p>
                                        <p class="text-sm flex-1 text-gray-400">{{(liveLocation?.attributes["totalDistance"]/1000).toFixed(2)}} Km</p>
                                    </div>
                                    <div class="flex my-2">
                                        <p class="text-sm flex-1">Accuracy:</p>
                                        <p class="text-sm flex-1 text-gray-400">{{(liveLocation?.accuracy ?? 0).toFixed(1)}}%</p>
                                    </div>
                                    <div v-if="!history" class="flex my-2 border-t">
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

                            

                        </div>
                        </div>
                    </div>
                </div>
            </div>
</template>