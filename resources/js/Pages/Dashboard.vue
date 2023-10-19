<template>
    <Head title="Dashboard" />
    <div class="">
      <div class="absolute top-0 bottom-0 right-0 left-0 lg:left-[350px]">
        <!--      <img src="./assets/map.png" class="h-full" />-->
        <div ref="mapContainer" id="map" class="h-full w-full"></div>
      </div>
        <div class="bg-gradient-to-r from-gray-100 lg:left-[350px] top-0 bottom-0 w-[50px] absolute"></div>

      <div class="absolute right-0 left-0">
        <TransitionRoot as="template" :show="sidebarOpen">
          <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="fixed inset-0 bg-gray-900/80" />
            </TransitionChild>
            <div class="fixed inset-0 flex">
              <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                  <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                      <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                      </button>
                    </div>
                  </TransitionChild>

                  <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
                    <div class="flex h-16 shrink-0 items-center">
                      <img class="h-8 w-auto" src="../assets/LOGO.png" alt="Dayalog" />
                    </div>
                    <nav class="flex flex-1 flex-col">
                      <ul role="list" class="-mx-2 flex-1 space-y-1">
                        <li v-for="item in navigation" :key="item.name">
                          <Link :href="item.href" :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                            <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                            {{ item.name }}
                          </Link>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </DialogPanel>
              </TransitionChild>
            </div>
          </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-20 lg:overflow-y-auto lg:bg-[#002760] lg:pb-4 rounded-lg m-4 animate__animated animate__fadeInLeft animate__faster">
          <div class="flex h-16 shrink-0 items-center justify-center">
            <img class="h-8 w-auto" src="../assets/LOGO.png" alt="Dayalog" />
          </div>
          <nav class="mt-8">
            <ul role="list" class="flex flex-col items-center space-y-1">
              <li v-for="item in navigation" :key="item.name">
                <Link :href="item.href" :class="[item.href.endsWith(url) ? 'bg-black bg-opacity-30 text-red' : 'text-gray-400 hover:text-white hover:bg-black hover:bg-opacity-20', 'group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold']">
                  <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                  <span class="sr-only">{{ item.name }}</span>
                </Link>
              </li>
            </ul>
          </nav>
        </div>

        <div class="lg:pl-20">
          <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-md sm:gap-x-6 sm:px-6 lg:px-8 lg:my-4 mr-4 ml-8 rounded-lg animate__animated animate__fadeInDown">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
              <span class="sr-only">Open sidebar</span>
              <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>

            <!-- Separator -->
            <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true" />

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
              <form class="relative flex flex-1" action="#" method="GET">
                <label for="search-field" class="sr-only">Search</label>
                <MagnifyingGlassIcon class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" aria-hidden="true" />
                <input id="search-field" class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." type="search" name="search" />
              </form>
              <div class="flex items-center gap-x-4 lg:gap-x-6">
                <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">View notifications</span>
                  <BellIcon class="h-6 w-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true" />

                <!-- Profile dropdown -->
                <Menu as="div" class="relative">
                  <MenuButton class="-m-1.5 flex items-center p-1.5">
                    <span class="sr-only">Open user menu</span>
                    <!-- <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" /> -->
                    <span class="hidden lg:flex lg:items-center">
                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ user.name }}</span>
                    <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                  </MenuButton>
                  <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                    <MenuItems class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                      <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                        <Link :href="item.href" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">{{ item.name }}</Link>
                      </MenuItem>
                    </MenuItems>
                  </transition>
                </Menu>
              </div>
            </div>
          </div>

          <main class="xl:pl-96">
            <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
              <!-- Main area -->
            </div>
          </main>
        </div>

        <aside class="fixed bottom-0 left-20 top-16 hidden w-96 border-r border-gray-200 px-4 py-6 sm:px-6 lg:px-8 xl:block animate__animated animate__fadeIn">
          <!-- Secondary column (hidden on smaller screens) -->
          <div id="driver-list" class="mt-8 w-full overflow-y-auto bg-white h-40 shadow-lg rounded-md transition-all ease-in-out duration-300">
            <p>Devices</p>
              <div  v-for="(location, index) in locations" @click="selectedDevice = location.deviceData.id;centerMapToPosition(location.positionData.latitude,location.positionData.longitude)">
                  <div class="flex p-4 cursor-pointer items-center" v-if="location.title.toLowerCase()!=='ivan tracker' && location.positionData ">
                      <p class="mr-2 text-gray-500 text-sm">{{index}}</p>
                      <div
                          class="flex items-center justify-center rounded-full h-[40px] w-[40px] bg-gray-400 text-white">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                               stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                          </svg>
                      </div>
                      <div class="flex-auto ml-2">
                          <p class="text-sm">{{ location.title }}</p>
                          <p class="text-sm font-bold"
                             :class="location.status.toLowerCase()==='online'?'text-green-500':'text-red-600'">
                              {{ location.status.toLowerCase()!=='online'?'Parked':'Online' }}</p>
                      </div>
                      <div>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                               class="w-6 h-6"
                               :class="location.positionData['attributes']['batteryLevel']>50?'text-green-400':'text-orange-400'">
                              <path fill-rule="evenodd"
                                    d="M3.75 6.75a3 3 0 00-3 3v6a3 3 0 003 3h15a3 3 0 003-3v-.037c.856-.174 1.5-.93 1.5-1.838v-2.25c0-.907-.644-1.664-1.5-1.837V9.75a3 3 0 00-3-3h-15zm15 1.5a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-6a1.5 1.5 0 011.5-1.5h15zM4.5 9.75a.75.75 0 00-.75.75V15c0 .414.336.75.75.75H18a.75.75 0 00.75-.75v-4.5a.75.75 0 00-.75-.75H4.5z"
                                    clip-rule="evenodd"/>
                          </svg>
                          <small>{{ location.positionData["attributes"]["batteryLevel"] }}{{
                                  location.positionData["attributes"]["batteryLevel"] ? '%' : ''
                              }}</small>
                      </div>
                  </div></div>
            <!-- <DriverList1 :routeFunction="showroute" :driver="props.driver" :drivers="props.drivers?.original" /> -->
          </div>
        </aside>
      </div>

    <div v-if="selectedLocation" class="absolute right-0 left-0 bottom-0 pb-4">
        <div class="w-[300px] mx-auto shadow-md rounded-md">

            <div class="p-4 bg-white">
                <div class="flex">
                    <p class="flex-auto">{{selectedLocation.title}}</p>
                    <button type="button" class="-m-2.5 p-2.5" @click="selectedDevice = false">
                        <span class="sr-only">Close device</span>
                        <XMarkIcon class="h-6 w-6 text-gray-500" aria-hidden="true" />
                    </button>
                </div>
                <br />
                <div class="flex my-2">
                    <p class="text-sm flex-1">Speed:</p>
                    <p class="text-sm flex-1 text-gray-400">{{selectedLocation.positionData.speed}}</p>
                </div>
                <div class="flex my-2">
                    <p class="text-sm flex-1">Total Distance:</p>
                    <p class="text-sm flex-1 text-gray-400">{{(selectedLocation.positionData.attributes["totalDistance"]/1000).toFixed(2)}} Km</p>
                </div>
                <div class="flex my-2">
                    <p class="text-sm flex-1">Accuracy:</p>
                    <p class="text-sm flex-1 text-gray-400">{{(selectedLocation.positionData.accuracy).toFixed(1)}}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
  </template>


  <script setup>
  import { ref} from 'vue'
  import Layout from '@/Layouts/NoLayout.vue';
  import DriverList1 from "@/Containers/DriverList1.vue";
  import { Loader } from "@googlemaps/js-api-loader"
  import markr from "@/assets/marker.png"
  import useTraccar from "@/composable/traccar"
  import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
  } from '@headlessui/vue'
  import {
    Bars3Icon,
    BellIcon,
    XMarkIcon,
  } from '@heroicons/vue/24/outline'
  import { ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
  import useNavigation from '@/composable'
  import { Head, Link, usePage } from '@inertiajs/vue3';
  import { computed, onMounted, watch } from 'vue';

  defineOptions({ layout: Layout })

  const { positions : tracarPositions, devices : tracarDevices } = useTraccar();
  const mapContainer = ref(null);
  const googleMap = ref(null);
  const googleMapMarkers = [];
  let selectedMarker = ref(-1);

  const page = usePage()
  const user = computed(() => page.props.auth.user)

  const props = defineProps(['devices', 'driver', 'drivers' ])

  const url = computed(() => usePage().url)
  const { navigation, userNavigation } = useNavigation()

  const sidebarOpen = ref(false)
  let loadingList = ref(true)


  setTimeout(function(){
    let element = document.getElementById("driver-list")
    element?.classList?.remove("h-40")
    element?.classList?.add("h-[85%]")
    loadingList.value = false;
  },1000)

  const loader = new Loader({
    apiKey: "AIzaSyAir29_hRhb99ll83YjLarlSbj-9su5zXI",
    version: "weekly",

  });

  const mapStyle = [
      /*{
          "featureType": "administrative",
          "elementType": "geometry",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },*/
      {
          "featureType": "administrative.land_parcel",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "administrative.land_parcel",
          "elementType": "labels",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "poi",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "poi",
          "elementType": "labels.text",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "poi.park",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "labels.icon",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "road.local",
          "elementType": "labels",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "transit",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      }
  ];

  let map;
  const markerImage = markr;
  const locations = computed(()=> {

    const devices = props.devices.map((device => {
        const latestPosition = tracarPositions.value.find(position => position.deviceId === device.id)
        return  {
        position: { lat: latestPosition?.latitude, lng: latestPosition?.longitude },
        title: device.name,
        status: device.status,
        positionData: latestPosition,
        deviceData: device,
    };
    }));
    return devices;
  })

  const selectedLocation = computed(()=>{
    if(selectedDevice.value){
          return locations.value.find(location => {
            return location.deviceData.id == selectedDevice.value
          });
    }else{
        return false;
    }
  })
  const locationMarkers = ref([])

    // watch works directly on a ref
  watch(locations ,(newLocations, oldLocations) => {
    if(googleMap.value){
        /*googleMapMarkers.forEach((marker, index) => {
            // console.log(marker.get('markerData').title, googleMapMarkers[index].get('markerData').position)
            const markerData = marker.get('markerData');
            if (!newLocations.find((newMarker) => newMarker === markerData)) {
                // marker.setMap(null); // Remove the marker from the map
            }
        });*/
        newLocations.forEach((newLocation, i) => {
            // console.log(newLocations[i])
            let newPosition = newLocation.position
            try {
                googleMapMarkers[i].setPosition(newPosition)
            } catch (e) {
                console.log(e)
            }

        })

    }
    //look
   })

  let selectedDevice = ref(false);

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
              console.log(newLocation.position)
              const marker = new google.maps.Marker({
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
                selectedDevice.value = newLocation.deviceData.id
                centerMapToPosition(newLocation.position.lat,newLocation.position.lng)
              });

              const bounds = new google.maps.LatLngBounds();
              locations.value.forEach(position => {
                  try {
                      bounds.extend(position.position);
                  } catch (e) {
                      console.log(e)
                  }
              });

              const padding = 150; // Adjust this padding as needed
            googleMap.value.fitBounds(bounds, padding);
          })
      });
  }



  function centerMapToPosition(lat,lng){
    googleMap.value.setZoom(12);
      setTimeout(function(){
        googleMap.value.panTo({lat: lat, lng: lng});
        googleMap.value.setZoom(15);
      }, 400)
  }
  let marker, directionsService, directionsRenderer;
  const markers = [
    { position: { lat: 0.297784, lng: 32.544896 }, title: "Marker 1" },
    { position: { lat: 0.292162, lng: 32.5485867 }, title: "Marker 2" },
  ];

  const clearMarkers = () => {
      // Loop through the markers array and set the map property to null
      for (const marker of locationMarkers.value) {
        marker.setMap(null);
      }

      // Clear the markers array
      locationMarkers.value = [];
    };

  const showroute  = () =>{
      clearMarkers();
    loader.load().then(async () => {
      const { Map } = await google.maps.importLibrary("maps");
      const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

      marker = markers.map((marker) => {
        const { position, title } = marker;

        return new google.maps.Marker({
          position,
          title,
          map,
          // icon: markerIcon
        });
      });

      let icons = {
        start:{
            url: markerImage,
            scaledSize: new google.maps.Size(40, 40),
        },
        end:{
            url: markerImage,
            scaledSize: new google.maps.Size(40, 40),
        }
      };

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        map,
        suppressMarkers: true,
      });

      // document.getElementById("show-route").addEventListener("click", () => {
      const waypoints = marker.map(({ position }) => ({ location: position }));
      const origin = waypoints.shift().location;
      const destination = waypoints.pop().location;

      directionsService.route(
          {
            origin,
            destination,
            // waypoints,
            travelMode: google.maps.TravelMode.DRIVING,
          },
          (response, status) => {
            if (status === "OK") {
              directionsRenderer.setDirections(response);
                directionsRenderer.setOptions({
                    polylineOptions: {
                        strokeColor: "#002c75", // Red color
                        strokeWeight: 4, // Line thickness
                        strokeOpacity: 0.7, // Line opacity (0-1)
                    },
                });
              let leg = response.routes[ 0 ].legs[ 0 ];
              // console.log(response,leg.end_location);
              makeMarker( origin, icons.start, "title" );
              makeMarker( destination, icons.end, 'title' );
            } else {
              window.alert(`Directions request failed due to ${status}`);
            }
          }
      );
      // });
    });
  }

  function makeMarker( position, icon, title ) {
    new google.maps.Marker({
      position: position,
      map: map,
      icon: icon,
      title: title
    });
  }

  onMounted(() => {
    loadMap()
  })

  </script>
