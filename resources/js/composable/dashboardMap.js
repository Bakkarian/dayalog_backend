import { onMounted, ref } from "vue";
import { Loader } from "@googlemaps/js-api-loader"
import { mapStyle } from '@/utils/index';
import markerImage from "@/assets/marker.png"

export default () =>{

    const mapContainer = ref(null);
    const googleMap = ref(null);
    const loaded = ref(false);
    const googleMapMarkers = [];


    const loader = new Loader({
        apiKey: "AIzaSyAir29_hRhb99ll83YjLarlSbj-9su5zXI",
        version: "weekly",
    });


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
        setBounds()
        loaded.value = true
        });
    }

    //to ensure bound is set every time a position is added
    function setBounds(){
        const bounds = new google.maps.LatLngBounds();
        //locations.value.forEach(position => {
            //TODO: to use markers
            // if (position.position.lat!==undefined) {
                // bounds.extend({});
            // }
        //});

        const padding = 150; // Adjust this padding as needed
        googleMap.value.fitBounds(bounds, padding);
    }


    const addMarker = (newLocation) => {
        const  { position, title } = newLocation
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
        marker.set('markerData', newLocation);
        googleMapMarkers.push(marker);
        return marker
    }


    const addMarkers = (positions) => {
        //TODO: add multiple markers
    }

    const updateMarker = (position) => {
        const markerIndex  = googleMapMarkers.findIndex((marker) => {
            return marker.markerData.positionData.deviceId == position.positionData.deviceId
        })


        //to do //set all other things
        googleMapMarkers[markerIndex].setPosition(position.position)
        googleMapMarkers[markerIndex].set('markerData', position);

        return googleMapMarkers[markerIndex];
    }

    const addMarkerFromPosition = (position) => {

    }

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


    return { mapContainer, googleMap, addMarker, addMarkers, updateMarker ,loaded, addMarkerFromPosition };
}
