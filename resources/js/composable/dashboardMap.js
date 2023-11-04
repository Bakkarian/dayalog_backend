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

    const loadMap = () => {
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
                  //if not empty
            if(googleMapMarkers.value.length != 0){
                for (var i = 0; i < googleMapMarkers.value.length; i++) {
                    googleMapMarkers.value[i].setMap(googleMap.value);
                }
            }
        });
    }

    //to ensure bound is set every time a position is added
    const setInitialBounds = () => {
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
    };

    const centerMapToPosition = (lat,lng) => {
        googleMap.value.setZoom(12);
          setTimeout(function(){
            googleMap.value.panTo({lat: lat, lng: lng});
            googleMap.value.setZoom(15);
          }, 400)
    }



    const centerMapToDevice = (deviceId) => {

        const marker  = googleMapMarkers.value.find((marker) => {
            return marker.markerId == deviceId
        })

        if(marker){
            const position  = marker.position
            centerMapToPosition(position.lat(), position.lng())
        }
    }

    const createRoute = (origin, destination, routeId = null) => {

        const directionsService = new google.maps.DirectionsService();

        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: googleMap.value,
            suppressMarkers: true, // Suppress default markers
        });

        const originLatLng = new google.maps.LatLng(origin.lat, origin.lng);
        const destinationLatLng = new google.maps.LatLng(destination.lat, destination.lng);

        const request = {
            origin: originLatLng,
            destination: destinationLatLng,
            travelMode: google.maps.TravelMode.DRIVING, // You can also use other modes like BICYCLING, TRANSIT, WALKING, etc.
        };

        directionsService.route(request, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(result);
                directionsRenderer.setOptions({
                    polylineOptions: {
                        strokeColor: "#002c75", // Red color
                        strokeWeight: 4, // Line thickness
                        strokeOpacity: 0.7, // Line opacity (0-1)
                    },
                });

            } else {
                console.error("Directions request failed: " + status);
            }
        });

        directionsRenderer.set('id', routeId ??  uid())

        googleRoutes.value.push(directionsRenderer)

        return directionsRenderer;
    }


    const removeRoute = (routeId) => {
        const routeIndex  = googleRoutes.value.findIndex((route) => {
            return route.id == routeId
        })
        if(routeIndex != -1){
            googleRoutes.value[routeIndex].setMap(null)
            googleRoutes.value.splice(routeIndex, 1);
            return true;
        }
        return false;
    }



    onMounted(()=>{
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
        clearMarkers,
        centerMapToDevice,
        loadMap,
        createRoute,
        removeRoute,
        googleRoutes
    };
}
export default useDashboardMap;
