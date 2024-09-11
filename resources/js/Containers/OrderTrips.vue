<script setup>
import { computed } from 'vue';
import TripDetails from './TripDetails.vue';
import TripStatusSelect from './TripStatusSelect.vue';
import { ClockIcon,  } from '@heroicons/vue/20/solid';
import { CheckCircleIcon } from '@heroicons/vue/24/outline';


const props = defineProps({
    vehiclesOrders: Array,
})


const trips = computed(() => {
    //from vehiclesOrders merge all dispatches into one array
    let trips = []
    props.vehiclesOrders.forEach(vehicleOrder => {
        vehicleOrder.dispatches.forEach(dispatch => {
            dispatch.vehicle = vehicleOrder.vehicle
            trips.push(dispatch)
        })
    })
    return trips
})


</script>

<template>
   <div class="flex flex-col space-y-4">
    <template v-for="trip in trips">
        <div class="flex items-center py-4 px-6 border-b border-gray-200 hover:bg-gray-50">
        <div class="flex-shrink-0">
            <CheckCircleIcon v-if="trip.status === 'reached'" class="h-6 w-6 text-green-500" />
            <ClockIcon v-else-if="trip.status === 'in_transit'" class="h-6 w-6 text-blue-500" />
            <ClockIcon v-else class="h-6 w-6 text-gray-400" />
        </div>
        <div class="flex-grow ml-4">
            <h3 class="text-base font-medium text-gray-900">
            {{ trip.origin }} to {{ trip.destination }}
            </h3>
            <p class="text-sm text-gray-500">
                <TripStatusSelect :trip="trip" />
            </p>
        </div>
            <TripDetails :trip="trip" class="ml-auto" />
        </div>
  </template>
</div>


</template>
