import { defineStore } from 'pinia'
import { computed, reactive, ref } from 'vue';


export const useMapStore = defineStore('map', () => {

    const mapContainer = ref(null);
    const googleMap = ref(null);
    const loaded = ref(false);

    const googleMapMarkers = ref([]);


    return {
        mapContainer,
        googleMap,
        loaded,
        googleMapMarkers,
     }
})


// ref()s become state properties
// computed()s become getters
// function()s become actions
