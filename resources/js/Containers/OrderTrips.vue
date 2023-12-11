<script setup>
import { computed } from 'vue';


const props = defineProps({
    vehiclesOrders: Array,
})


const trips = computed(() => {
    //from vehiclesOrders merge all dispatches into one array
    let trips = []
    props.vehiclesOrders.forEach(vehicleOrders => {
        vehicleOrders.dispatches.forEach(order => {
            trips.push(order)
        })
    })
    return trips
})

</script>

<template>
    <div>
        <p v-for="trip in trips">
            {{trip.origin }} to {{trip.destination}} - {{trip.status}}

            <button type="button" class="rounded bg-green-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-green-500" >View Delivery Details</button>
        </p>
    </div>

</template>
