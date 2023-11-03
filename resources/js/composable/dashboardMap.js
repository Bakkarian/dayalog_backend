import { onMounted, ref } from "vue";
import { Loader } from "@googlemaps/js-api-loader"
import { mapStyle } from '@/utils/index';
import markerImage from "@/assets/marker.png"
import { useMapStore } from '@/store'
import { storeToRefs } from 'pinia'

const useDashboardMap = () => {

    const store = useMapStore()
    const { mapContainer,googleMap ,loaded, googleMapMarkers, googleRoutes } = storeToRefs(store)


    const loader = new Loader({
        apiKey: "AIzaSyAir29_hRhb99ll83YjLarlSbj-9su5zXI",
        version: "weekly",
    });

    const uid = function(){
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    function loadMap(){
        loader.load().then(async () => {
          googleMap.value = new window.google.maps.Map(mapContainer.value, {
              center: { lat: 0.297784, lng: 32.544896 },
                zoom: 9,
                mapTypeId: 'roadmap',
                // mapId: "7c96e127d329f19d",
                styles: mapStyle,
                // Remove Controls
                streetViewControl: false, // Remove street view control
                // zoomControl: false, // Remove zoom control
                mapTypeControl: false, // Remove map type control
          });
          setInitialBounds()
        loaded.value = true
        });
    }

    //to ensure bound is set every time a position is added
    function setInitialBounds(){
        const bounds = new google.maps.LatLngBounds();
        bounds.extend({lat:0.501803719933128,lng:32.569388319449786});
        bounds.extend({lat:2.501803719933128,lng:32.569388319449786});

        const padding = 150; // Adjust this padding as needed
        googleMap.value.fitBounds(bounds, padding);
    }

    const addMarker = (newLocation ) => {
        const  { position, title , id } = newLocation
        const marker = new google.maps.Marker({
            position: position,
            map: googleMap.value,
            title: title,
            icon: {
                url: markerImage,
                scaledSize: new google.maps.Size(40, 40)
            },
            clickable: true,
            draggable: false,
        });
        marker.set('markerId', id ?? uid() );
        googleMapMarkers.value.push(marker);
        return marker
    }

    const addMarkers = (positions) => {
        //TODO: add multiple markers
    }

    const updateMarker = (position, id) => {
        const markerIndex  = googleMapMarkers.value.findIndex((marker) => {
            return marker.id == id
        })
        if(markerIndex != -1){
            googleMapMarkers.value[markerIndex].setPosition(position.position)
            return googleMapMarkers.value[markerIndex];
        }
        return false;
    }

    const addMarkerFromPosition = (position) => {

    }
    
    const clearMarkers = () => {
        // Loop through the markers array and set the map property to null
        for (const marker of googleMapMarkers) {
          marker.setMap(null);
        }
        // Clear the markers array
        googleMapMarkers = [];
    };


    const centerMapToPosition = (lat,lng) => {
        googleMap.value.setZoom(12);
          setTimeout(function(){
            googleMap.value.panTo({lat: lat, lng: lng});
            googleMap.value.setZoom(15);
          }, 400)
      }



    onMounted(()=>{
        loadMap()
    })


    return {
        mapContainer,
        googleMap,
        addMarker,
        addMarkers,
        updateMarker ,
        loaded,
        addMarkerFromPosition,
        centerMapToPosition,
        clearMarkers
    };
}
export default useDashboardMap;
