import { defineStore } from 'pinia'
import {ref, toRaw, watch } from 'vue';


export const useMapStore = defineStore('map', () => {

    const devices = ref([])

    const mapContainer = ref(null);
    const googleMap = ref(null);
    const googlePolyline = ref(null)

    const loaded = ref(false);

    const googleMapMarkers = ref([]);
    const googleRoutes = ref([]);

    function $reset() {
        googlePolyline.value = null,
        googleMapMarkers.value = [];
        googleRoutes.value = [];
        loaded.value = false;

      }
    

    watch([() => googleMapMarkers.value ],([newGoogleMapMarkers],[oldGoogleMapMarkers]) => {
        if (oldGoogleMapMarkers?.length > 0) {
            toRaw(oldGoogleMapMarkers).forEach((marker) => { 
                //check if is a Proxy
               toRaw(marker).setMap(null)
            });
        }

        if (newGoogleMapMarkers?.length > 0) {
            toRaw(newGoogleMapMarkers).forEach((marker) => {
                toRaw(marker).setMap(googleMap.value)
            });
        }
    })


    watch([() => googlePolyline.value ], ([newGooglePolyline],[oldGooglePolyline]) => {
      if(oldGooglePolyline){
        toRaw(oldGooglePolyline).setMap(null)
      }
      if(newGooglePolyline){
          toRaw(newGooglePolyline).setMap(googleMap.value)
      }
   })



    return {
        mapContainer,
        googleMap,
        loaded,
        googleMapMarkers,
        googleRoutes,
        devices,
        googlePolyline,
        $reset
     }
})


// ref()s become state properties
// computed()s become getters
// function()s become actions
