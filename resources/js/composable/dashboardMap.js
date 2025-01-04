import { onMounted, onUnmounted, ref, toRaw, watch } from "vue";
import { Loader } from "@googlemaps/js-api-loader"
import { mapStyle } from '@/utils/index';
import markerImage from "@/assets/marker.png"
import { useMapStore } from '@/store'
import { storeToRefs } from 'pinia'
import useTraccar from "@/composable/traccar"

const useDashboardMap = () => {

    const store = useMapStore()

    const {
        mapContainer,
        googleMap,
        loaded,
        googleMapMarkers,
        googleRoutes,
        devices,
        googlePolyline,
    } = storeToRefs(store)


    //TODO: Change this whole file to event driven (If a variable changes it re renders for example if a marker is added or removed the map is rendered again)

    const { positions : tracarPositions, devices:traccarDevices, events:tracarEvents, onDevicePositionChanged } = useTraccar();

    const onLoadedFunction = ref(false);

    const loader = new Loader({
        apiKey: "AIzaSyAir29_hRhb99ll83YjLarlSbj-9su5zXI",
        version: "weekly",
    });

    const uid = function(){
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    const loadMap = (options = {}) => {
        loader.importLibrary('maps').then(async () => {
            if(!mapContainer.value) return
                googleMap.value = new window.google.maps.Map( mapContainer.value, {
                    center: {
                        lat: 0.297784,
                        lng: 32.544896
                    },
                    zoom: 9,
                    mapTypeId: 'roadmap',
                    styles: mapStyle,
                    streetViewControl: false, // Remove street view control
                    mapTypeControl: false, // Remove map type control
                    ...options,
                });
                setInitialBounds()
                loaded.value = true
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

    const addMarker = (newLocation, markerId = null ,options = {} ) => {
        const  { position, title , id } = newLocation
        const marker = new google.maps.Marker({
            position: position,
            title: title ?? '',
            icon: {
                url: markerImage,
                scaledSize: new google.maps.Size(40, 40)
            },
            clickable: true,
            draggable: false,
            ...options
        });
        marker.set('markerId',  markerId ?? (id ?? uid()) );
        googleMapMarkers.value = [...googleMapMarkers.value, marker];
        return marker
    }

    const addMarkers = (positions) => {
        //TODO: add multiple markers
    }

    const updateMarker = (position, id) => {
        const markerIndex  = googleMapMarkers.value.findIndex((marker) => {
            return marker.markerId == id
        })
        if(markerIndex != -1){
            googleMapMarkers.value[markerIndex].setPosition({ lat: position?.latitude, lng: position?.longitude },)
            return googleMapMarkers.value[markerIndex];
        }
        return false;
    }

    const removeMarker = (id) => {
        const markerIndex  = googleMapMarkers.value.findIndex((marker) => {
            return marker.markerId == id
        })
        if(markerIndex != -1){
            googleMapMarkers.value = [...googleMapMarkers.value.filter((marker) => marker.markerId != id )]
            return true;
        }
        return false;
    }

    const addMarkerFromPosition = (position, markerId = null ,options = {} ) => {
        position = { ...position, lat: position.latitude, lng: position.longitude }
        const marker = new google.maps.Marker({
            position: position,
            icon: {
                url: markerImage,
                scaledSize: new google.maps.Size(40, 40)
            },
            clickable: true,
            draggable: false,
            ...options
        });
        marker.set('markerId',  markerId ?? (id ?? uid()) );
        googleMapMarkers.value = [...googleMapMarkers.value, marker];
        return marker
    }

    const updateAddMarkerFromPosition = (position, id) => {

        position = { ...position, lat: position.latitude, lng: position.longitude }

        const markerIndex  = googleMapMarkers.value.findIndex((marker) => {
            return marker.markerId == id
        })

        if(markerIndex != -1){
            googleMapMarkers.value[markerIndex].setPosition({ lat: position?.latitude, lng: position?.longitude },)
            return googleMapMarkers.value[markerIndex];
        }

        return false;
    }

    const clearMarkers = () => {
        googleMapMarkers.value = [];
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
    const centerAndZoomMap = (locations) => {
        // Create a new LatLngBounds object
        const bounds = new google.maps.LatLngBounds();
        // Extend bounds for each location point
        locations.forEach((location) => {
            const latLng = new google.maps.LatLng(location.lat, location.lng);
            bounds.extend(latLng);
        });

        googleMap.value.fitBounds(bounds);

        const currentZoom = googleMap.value.getZoom();
        googleMap.value.setZoom(currentZoom - 0.3); // Zoom in sligh
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
            googleRoutes.value.splice(routeIndex, 1);
            return true;
        }
        return false;
    }

    const createRouteWithPlaces = (originName, destinationName, routeId = null) => {
        const geocoder = new google.maps.Geocoder();
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: googleMap.value,
            suppressMarkers: true,
        });

        // Geocode origin and destination names to get coordinates
        const geocodePromises = [geocodePlace(geocoder, originName), geocodePlace(geocoder, destinationName)];

        Promise.all(geocodePromises)
        .then(([originLatLng, destinationLatLng]) => {
            const request = {
                origin: originLatLng,
                destination: destinationLatLng,
                travelMode: google.maps.TravelMode.DRIVING,
            };

            directionsService.route(request, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                    directionsRenderer.setOptions({
                        polylineOptions: {
                            strokeColor: "#002c75",
                            strokeWeight: 4,
                            strokeOpacity: 0.7,
                        },
                    });
                } else {
                    console.error("Directions request failed: " + status);
                }
            });

            directionsRenderer.set('id', routeId ??  uid());
            googleRoutes.value.push(directionsRenderer);
        })
        .catch(error => {
            console.error("Geocoding failed: ", error);
        });

        return directionsRenderer;
    };

    const geocodePlace = (geocoder, placeName) => {
        return new Promise((resolve, reject) => {
            geocoder.geocode({ 'address': placeName }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    resolve(results[0].geometry.location);
                } else {
                    reject("Geocoding failed for place: " + placeName);
                }
            });
        });
    };

    const plotHistory = (locations, pathId = null ) => {

        const markers = [];

        locations = locations.map((position) => {
            return { lat: position.latitude, lng: position.longitude, ...position }
        })

        const markersPoints = locations.filter((_, index) => index % 15 === 0)

        markersPoints.forEach((location, index) => {
            const marker = new google.maps.Marker({
                position: location,
                icon: {
                    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                    scale: 2,
                    rotation : location?.course ?? 0,
                },
            });
            marker.markerId = uid();
            marker.setMap(googleMap.value);
            googleMapMarkers.value = [...googleMapMarkers.value, marker];
            markers.push(marker);
        });
        // Draw lines connecting the markers
        const polyline = new google.maps.Polyline({
          path: locations,
          strokeColor: "#FF0000",
          strokeOpacity: 1.0,
          strokeWeight: 2,
        });

        polyline.set('markers', markers );
        googlePolyline.value = polyline

    }


    const clearPolylines = () => {
        if (googlePolyline.value) {
            const markers = googlePolyline.value.get('markers');
            const markersIds = markers.map(marker => marker.markerId);

            markersIds.forEach(markerId => {
               googleMapMarkers.value = googleMapMarkers.value.filter(marker => marker.markerId !== markerId);
            });

            googlePolyline.value = null;
        }
    }

    const removePolyline = (pathId) => {
        if(googlePolyline.value){
            googlePolyline.value = null;
        }
    }



    const buildLocationFromDevice = (device) => {
            let latestPosition = tracarPositions.value.find(position => position.deviceId === device.id)

            if(!latestPosition){
                latestPosition = device.last_position
            }

            return  {
                position: {
                    lat: latestPosition?.latitude,
                    lng: latestPosition?.longitude
                },
                title: device.name,
                positionData: latestPosition,
                ...device
        };
    }


    const addMarkerWithClickEvent = (newLocation, callback, ...args) => {
        if(newLocation){
            const marker = addMarker(newLocation);
            marker.addListener('click', (e) => callback(e,marker, ...args));
        }
    };



    const onMapLoaded = (callback ) => {
        onLoadedFunction.value = callback;
    };

    const resetMapStore = () => {
        store.$reset()
    }

     watch(loaded, (newLoaded) => {
         if(newLoaded && onLoadedFunction.value){
             onLoadedFunction.value()
         }
     })

    onDevicePositionChanged((position) => {
        updateMarker(position, position.deviceId)
    })



    return {
        mapContainer,
        devices,
        googleMap,
        addMarker,
        addMarkers,
        loaded,
        addMarkerFromPosition,
        updateAddMarkerFromPosition,
        centerMapToPosition,
        clearMarkers,
        centerMapToDevice,
        loadMap,
        createRoute,
        removeRoute,
        googleRoutes,
        buildLocationFromDevice,
        onMapLoaded,
        addMarkerWithClickEvent,
        createRouteWithPlaces,
        plotHistory,
        removePolyline,
        clearPolylines,
        removeMarker,
        resetMapStore,
        tracarPositions,
        traccarDevices,
        centerAndZoomMap
    };
}
export default useDashboardMap;
