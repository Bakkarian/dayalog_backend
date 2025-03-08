<script setup>
import { computed } from 'vue';
import TripDetails from './TripDetails.vue';
import TripStatusSelect from './TripStatusSelect.vue';
import { ClockIcon, CheckCircleIcon } from '@heroicons/vue/24/outline';


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
  <div class="space-y-4 pt-5">
    <div v-for="trip in trips" :key="trip.id" class="bg-white rounded-lg border border-gray-200 p-4 transition duration-300 ease-in-out hover:bg-gray-50">
      <div class="flex items-start justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <CheckCircleIcon v-if="trip.status === 'reached'" class="h-6 w-6 text-green-500" />
            <ClockIcon v-else-if="trip.status === 'in_transit'" class="h-6 w-6 text-blue-500" />
            <ClockIcon v-else class="h-6 w-6 text-gray-400" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-semibold text-gray-900">
              {{ trip.origin }} &rarr; {{ trip.destination }}
            </h3>
            <p class="text-gray-500 text-sm">{{ trip.vehicle.license_plate }}</p>
          </div>
        </div>

        <div class="ml-auto">
          <TripDetails :trip="trip" class="flex items-center" />
        </div>
      </div>
      
      <TripStatusSelect :trip="trip" class="mt-2" />

    </div>
  </div>

</template>

