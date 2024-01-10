import { defineStore } from 'pinia'
import { computed, reactive, ref } from 'vue';


export const useMapStore = defineStore('map', () => {

    const mapContainer = ref(null);
    const googleMap = ref(null);
    const loaded = ref(false);

    const googleMapMarkers = ref([]);
    const googleRoutes = ref([]);
    const selectedDevice = ref(null);


    function increment() {
      count.value++
    }

    return {
        selectedDevice,
        mapContainer,
        googleMap,
        loaded,
        googleMapMarkers,
        increment,
        googleRoutes,
     }
})


// ref()s become state properties
// computed()s become getters
// function()s become actions
