<script setup>
    import LocalDateTimeStampInput from '@/Components/LocalDateTimeStampInput.vue';
    import useDashboardMap from '@/composable/dashboardMap';
    import {
        BackwardIcon,
        ForwardIcon, 
        PauseIcon, 
        PlayIcon, 
    } from '@heroicons/vue/24/outline'
    import { Link, useForm, usePage } from '@inertiajs/vue3';
    import { computed, onMounted, onUnmounted, reactive, ref, watch } from 'vue';
    import markerImage from '@/assets/trackMarker.png';

    const { removeMarker, addMarkerFromPosition, updateAddMarkerFromPosition, plotHistory, clearPolylines, centerAndZoomMap, centerMapToDevice } = useDashboardMap()

    const props = computed(() => usePage().props)
    const history = computed(() => props.value.history)
    const device = computed(() => props.value.device)
    const currentHistoryPosition = computed(() => parseInt(props.value.currentHistoryPosition))
    const historyFrom = computed(() => props.value.historyFrom)
    const historyTo = computed(() => props.value.historyTo)


    const historyPositions = computed(() => props.value.historyPositions)

    const currentPosition = ref(null)
    const playing = ref(false)
    const intervalId = ref(null)

    watch(() => currentPosition.value, (newCurrentPosition) => {
        if(historyPositions.value[newCurrentPosition]){
            updateAddMarkerFromPosition(historyPositions.value[newCurrentPosition], 'current' )
        }else{
        }
    })

    const updateCurrentPosition = (index) => {
        currentPosition.value = parseInt(index)
    }


    watch(()=> historyPositions.value, (newHistoryPositions) => {
        if(newHistoryPositions){

            if(historyPositions.value[currentHistoryPosition.value]){
                removeMarker('current')
                addMarkerFromPosition(
                    historyPositions.value[currentHistoryPosition.value],
                    'current', {
                        icon: {
                            url: markerImage,
                            scaledSize: new google.maps.Size(40, 40)
                        }
                } )
            }

            clearPolylines();
            plotHistory(newHistoryPositions, 'history');
            const x = newHistoryPositions.map(position => {return {lat: position.latitude, lng: position.longitude}});
            
            if(x.length > 0){
                centerAndZoomMap(x)
            }else{
                centerMapToDevice(device.value.id)
            }
            currentPosition.value = 0;          
        }

    })

    onMounted(() => {
        plotHistory(historyPositions.value, 'history')
        currentPosition.value = currentHistoryPosition.value

        if(historyPositions.value[currentHistoryPosition.value]){
                removeMarker('current')
                addMarkerFromPosition(
                    historyPositions.value[currentHistoryPosition.value],
                    'current', {
                        icon: {
                            url: markerImage,
                            scaledSize: new google.maps.Size(40, 40)
                        }
                } )
            }

        const x = historyPositions.value.map(position => {return {lat: position.latitude, lng: position.longitude}});

        if(x.length > 0){
            centerAndZoomMap(x)
        }else{
            centerMapToDevice(device.value.id)
        }

    })

    onUnmounted(() => {
        clearInterval(intervalId.value)
        removeMarker('current')
        clearPolylines();
    })




    const play = () => {
        if(playing.value){
            return
        }
        playing.value = true

        intervalId.value = setInterval(() => {
            if(currentPosition.value >= historyPositions.length -1){
                pause();
                currentPosition.value = 0
                return
            }
            updateCurrentPosition((++currentPosition.value))
        }, 500)
        
    }

    const pause = () => {
        clearInterval(intervalId.value)
        playing.value = false
    }

    const selectRange = reactive({
        historyFrom: historyFrom.value,
        historyTo: historyTo.value,
        get(){
            this.historyFrom = historyFrom.value
            this.historyTo = historyTo.value
        }
    })

    const historyRoute = computed(() => {
        return route('dashboard', {
            device: device.value.id,
            history: true,
            historyFrom: selectRange.historyFrom,
            historyTo: selectRange.historyTo
        })
    })


</script>

<template>

<div class="w-fit" >

    <div class="mb-4">
        <div class="flex justify-between">
            <div class="flex space-x-2">
                <div class="w-full">
                    <label for="start-date" class="block text-sm font-medium leading-6 text-gray-900">Start Date</label>
                    <LocalDateTimeStampInput v-model="selectRange.historyFrom" />
                </div>
                <div class="w-full">
                    <label for="end-date" class="block text-sm font-medium leading-6 text-gray-900">End Date</label>
                    <LocalDateTimeStampInput v-model="selectRange.historyTo" />
                </div>
                <div class="w-full">
                    <div class="h-6"></div>
                    <Link
                            :href="historyRoute"  
                            @click="pause"
                             preserve-state
                            class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white \
                                     shadow-sm ring-1 ring-inset ring-indigo-600 hover:bg-indigo-500">
                        Submit
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <input type="range" v-model.number="currentPosition" class="w-full" id="points" name="points" min="0" :max="historyPositions.length">
        <br />
        <div class="flex w-full justify-center space-x-2">
            <div class="flex space-x-2">
                <button  @click="updateCurrentPosition((currentPosition -1))">
                    <BackwardIcon class="h-5 w-5 rounded-full "></BackwardIcon>
                </button>
            
                <button v-if="!playing" class="p-2 bg-gray-100 rounded-full " @click="play()">
                    <PlayIcon class="h-5 w-5"></PlayIcon>
                </button>
                <button v-else class="p-2 bg-gray-100 rounded-full " @click="pause()">
                    <PauseIcon class="h-5 w-5"></PauseIcon>
                </button>

                <button @click="updateCurrentPosition( (currentPosition+1))">
                    <ForwardIcon class="h-5 w-5 rounded-full "></ForwardIcon>
                </button>
            </div>        
    </div>




    </div>
</div>
</template>
