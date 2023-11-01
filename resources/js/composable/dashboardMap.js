import { onMounted, ref } from "vue";
import { Loader } from "@googlemaps/js-api-loader"
import { mapStyle } from '@/utils/index';

export default () =>{

    const mapContainer = ref(null);
    const googleMap = ref(null);
    const markers = ref([])


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
            locations.value.forEach((newLocation, i) => {
                // console.log(newLocation.position)
                let marker;
                if (newLocation.position.lat!==undefined && newLocation.title.toLowerCase()!=='ivan tracker') {
                    marker = new google.maps.Marker({
                        position: newLocation.position,
                        map: googleMap.value,
                        title: newLocation.title,
                        deviceId: newLocation.deviceData.id,
                        icon: {
                            url: markerImage,
                            scaledSize: new google.maps.Size(40, 40)
                        },
                        clickable: true,
                        draggable: false,
                    });
                    marker.set('markerData', newLocation);
                    googleMapMarkers.push(marker);

                    marker.addListener('click', () => {
                        // infowindow.open(map, marker);
                        // selectedDevice.value = newLocation.deviceData.id
                        // centerMapToPosition(newLocation.position.lat,newLocation.position.lng)
                    });

                }
            });
            setBounds()
        });
    }

    function setBounds(){
        const bounds = new google.maps.LatLngBounds();
        locations.value.forEach(position => {
            if (position.position.lat!==undefined) {
                bounds.extend(position.position);
            }
        });

        const padding = 150; // Adjust this padding as needed
        googleMap.value.fitBounds(bounds, padding);
    }


    const addMarker = (marker) => {

    }


    const addMarkers = (markers) => {

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


    return { mapContainer, googleMap, addMarker, addMarkers };
}
