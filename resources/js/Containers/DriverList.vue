<script setup>
    import { onMounted, ref, computed} from "vue";
    import {  usePage } from '@inertiajs/vue3';
    import DriverListItem from "./DriverListItem.vue";

    const props = (computed(() => usePage().props))
    const devices = computed(() => props.value.devices)
    const driverList = ref(null)


onMounted(() => {
    setTimeout(function(){
        if(driverList.value){
            driverList.value.classList.remove("h-40")
            driverList.value.classList.add("h-[85%]")            
        }
    },1000)
})


</script>

<template>
    <div ref="driverList" id="driver-list" class="mt-8 w-full overflow-y-auto bg-white h-40 shadow-lg rounded-md transition-all ease-in-out duration-300">
            <DriverListItem  v-for="(device, index) in devices"  :key="index" :device="device"  />
    </div>
</template>
